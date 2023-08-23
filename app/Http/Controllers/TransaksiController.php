<?php

namespace App\Http\Controllers;
// namespace App\Http\Controllers\DataProduk;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Jasa;
use App\Models\Cabang;
use App\Models\Customer;
use App\Models\DataToko;
use App\Models\DataUser;
use App\Models\Kategori;
use App\Models\RoleMenu;
use App\Models\Data_Menu;
use App\Models\Transaksi;
use App\Models\DataProduk;
use App\Models\AksesCabang;
use Illuminate\Http\Request;
use App\Models\AditionalProduk;
use App\Models\TransaksiDetail;
use App\Exports\TransaksiExport;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\TransaksiDetailAditional;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;



class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index() {
        
    //     $dataTransaksi = Transaksi::with('user')->orderBy('id_transaksi', 'DESC')->paginate(10);
    //     return view('transaksi.index', compact('dataTransaksi'));
    // }

    public function index(Request $request) {
        $user_id = Auth::id();
        $query = Transaksi::where('user_id', $user_id)
            ->with('user')
            ->orderBy('id_transaksi', 'DESC');
    
        // Filter berdasarkan nama customer jika pencarian diisi
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->whereHas('customer', function ($q) use ($searchTerm) {
                $q->where('nama_customer', 'LIKE', "%$searchTerm%");
            });
        }
    
        $dataTransaksi = $query->paginate(10);

        // menu
        // $mainMenus = Data_Menu::where('menu_category', 'master menu')->get();
        // $menuItemsWithSubmenus = [];
        
        // foreach ($mainMenus as $mainMenu) {
        //     $subMenus = Data_Menu::where('menu_sub', $mainMenu->menu_id)
        //                         ->where('menu_category', 'sub menu')
        //                         ->orderBy('menu_position')
        //                         ->get();

        //     $menuItemsWithSubmenus[] = [
        //         'mainMenu' => $mainMenu,
        //         'subMenus' => $subMenus,
        //     ];
        // }

        $user_id = auth()->user()->user_id; // Use 'user_id' instead of 'id'

            $user = DataUser::find($user_id);
            $role_id = $user->role_id;

            $menu_ids = RoleMenu::where('role_id', $role_id)->pluck('menu_id');

            $mainMenus = Data_Menu::where('menu_category', 'master menu')
                ->whereIn('menu_id', $menu_ids)
                ->get();

            $menuItemsWithSubmenus = [];

            foreach ($mainMenus as $mainMenu) {
                $subMenus = Data_Menu::where('menu_sub', $mainMenu->menu_id)
                    ->where('menu_category', 'sub menu')
                    ->whereIn('menu_id', $menu_ids)
                    ->orderBy('menu_position')
                    ->get();

                $menuItemsWithSubmenus[] = [
                    'mainMenu' => $mainMenu,
                    'subMenus' => $subMenus,
                ];
            }
    
        return view('transaksi.index', compact('dataTransaksi','menuItemsWithSubmenus'));
    }
    
    // public function index() {
    //     $user_id = Auth::id();
    
    //     $dataTransaksi = Transaksi::where('user_id', $user_id)
    //         ->with('user') // Pastikan Anda sudah memiliki relasi 'user' di model Transaksi
    //         ->orderBy('id_transaksi', 'DESC')
    //         ->paginate(10);
    
    //     return view('transaksi.index', compact('dataTransaksi'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $dataKategori = Kategori::all(); 
        $dataCustomer = Customer::all(); 
        
        // $dataCabang = Cabang::all(); 
        $loggedInUser = auth()->user();
        $dataCabang = AksesCabang::where('user_id', $loggedInUser->user_id)->with('cabang')->get();
        // Cek apakah data cabang kosong, jika ya, tampilkan semua cabang
        if ($dataCabang->isEmpty()) {
            $allCabang = Cabang::all();

        }
        $allCabang = Cabang::all();

        // dd($dataCabang);
        $dataTransaksi = Transaksi::with('jasa')->get();
        $dataJasa = Jasa::with('kategori')->get();
        // $dataProduk = DataProduk::with('kategori')->get();
        $selectedKategoriId = $request->input('selectedKategori', null);

        // If a category is selected, filter the products by the selected category
        if ($selectedKategoriId) {
            $dataJasa = Jasa::whereHas('kategori', function ($query) use ($selectedKategoriId) {
                $query->where('id_kategori', $selectedKategoriId);
            })->with('kategori')->get();
        } else {
            // If no category is selected, get all products
            $dataJasa = Jasa::with('kategori')->get();
        }

        // $dataAditional = AditionalProduk::all();
        $dataTransaksiDetail = TransaksiDetail::where('id_transaksi', NULL)->with('transaksi')->get();
        // dd($dataTransaksiDetail);
        // dd($dataProduk);
        
        $dataUser = DataUser::all();
   
        // menu
        // $mainMenus = Data_Menu::where('menu_category', 'master menu')->get();
        // $menuItemsWithSubmenus = [];
        
        // foreach ($mainMenus as $mainMenu) {
        //     $subMenus = Data_Menu::where('menu_sub', $mainMenu->menu_id)
        //                         ->where('menu_category', 'sub menu')
        //                         ->orderBy('menu_position')
        //                         ->get();

        //     $menuItemsWithSubmenus[] = [
        //         'mainMenu' => $mainMenu,
        //         'subMenus' => $subMenus,
        //     ];
        // }

        $user_id = auth()->user()->user_id; // Use 'user_id' instead of 'id'

            $user = DataUser::find($user_id);
            $role_id = $user->role_id;

            $menu_ids = RoleMenu::where('role_id', $role_id)->pluck('menu_id');

            $mainMenus = Data_Menu::where('menu_category', 'master menu')
                ->whereIn('menu_id', $menu_ids)
                ->get();

            $menuItemsWithSubmenus = [];

            foreach ($mainMenus as $mainMenu) {
                $subMenus = Data_Menu::where('menu_sub', $mainMenu->menu_id)
                    ->where('menu_category', 'sub menu')
                    ->whereIn('menu_id', $menu_ids)
                    ->orderBy('menu_position')
                    ->get();

                $menuItemsWithSubmenus[] = [
                    'mainMenu' => $mainMenu,
                    'subMenus' => $subMenus,
                ];
            }
        
        // $dataTransaksiDetail = TransaksiDetail::with('produk')->get();
        return view('transaksi.create', compact('dataTransaksi','dataUser','dataJasa','dataTransaksiDetail','dataKategori','selectedKategoriId', 'dataCabang', 'dataCustomer','allCabang','menuItemsWithSubmenus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
 * Store a newly created resource in storage.
 */
    public function storeTransaksi(Request $request){
    $request->validate([
        'tanggal_selesai' => 'required|date', // Tanggal selesai harus diisi dan merupakan tanggal
        'id_customer' => 'required|string',
        'id_cabang' => 'required|string',
    ]);


    $totalHargaSetelahDiskon = $request->input('total_harga');
    $totalHargaSetelahDiskon = str_replace(['.', ','], '', $totalHargaSetelahDiskon); // phpcs:ignore ..DetectWeakValidation.Found
    $totalKembalianInput  = $request->input('total_kembalian');
    $totalKembalianInput  = str_replace(['.', ','], '', $totalKembalianInput );
    $totalBayarInput   = $request->input('total_bayar');
    $totalBayarInput   = str_replace(['.', ','], '', $totalBayarInput  );
    
    $existingTransaksiDetails = TransaksiDetail::whereNull('id_transaksi')->get();
    $user_id = Auth::id();
    $dataTransaksi = Transaksi::create([
        'user_id' => $user_id,
        'id_customer' => $request->id_customer,
        'id_cabang' => $request->id_cabang,
        'tanggal_transaksi' => $request->tanggal_transaksi,
        'tanggal_selesai' => $request->tanggal_selesai,
        'total_harga' => $totalHargaSetelahDiskon,
        'total_bayar' => $totalBayarInput,
        'total_kembalian' => $totalKembalianInput,
        'status' => $request->status,
        'diskon_transaksi' => empty($request->diskon_transaksi) ? 0 : $request->diskon_transaksi,
    ]);

    foreach ($existingTransaksiDetails as $existingTransaksiDetail) {
        // Update the id_transaksi on each TransaksiDetail
        $existingTransaksiDetail->update([
            'id_transaksi' => $dataTransaksi->id_transaksi
        ]);
    }
    // session(['id_transaksi_baru' => $dataTransaksi->id_transaksi]);

    $request->session()->forget('id_transaksi_baru');

    return redirect()->route('transaksi.index')->with('success', 'Pembayaran berhasil disimpan.');

}



public function store(Request $request)
{
    // Retrieve the Jasa model based on the provided id_jasa
    $jasa = Jasa::find($request->id_jasa);

    // Check if the Jasa model was found
    if ($jasa) {
        // Create a new TransaksiDetail record using the retrieved Jasa data
        $transaksiDetail = TransaksiDetail::create([
            'id_transaksi' => $request->id_transaksi,
            'id_jasa' => $jasa->id_jasa, // Use the id_jasa attribute from the Jasa model
            'jumlah_jasa' => $request->jumlah_jasa,
            'harga_perkg' => $jasa->harga_perkg,
            'diskon_jasa' => $jasa->diskon_jasa
        ]);

        // Redirect the user with a success message
        return redirect()->route('transaksi.create')->with('success', 'TransaksiDetail created successfully.');
    } else {
        // Handle the case where $jasa is not found
        // For example, you can redirect back with an error message
        return redirect()->back()->with('error', 'Jasa not found.');
    }
}

public function searchJasa(Request $request)
{
    $keyword = $request->input('keyword');
    $selectedKategoriId = $request->input('selectedKategori');

    // Query untuk mencari produk berdasarkan nama
    $dataJasa= Jasa::where('jenis_layanan', 'LIKE', "%$keyword%")
        ->when($selectedKategoriId, function ($query) use ($selectedKategoriId) {
            // If a category is selected, filter the products by the selected category
            $query->whereHas('kategori', function ($subQuery) use ($selectedKategoriId) {
                $subQuery->where('id_kategori', $selectedKategoriId);
            });
        })
        ->with('kategori')
        ->get();

    $dataKategori = Kategori::all();
    $dataCustomer = Customer::all();
    // $dataCabang= Cabang::all();
    // $loggedInUser = auth()->user();
    // $dataCabang = AksesCabang::where('user_id', $loggedInUser->user_id)->with('cabang')->get();
    $loggedInUser = auth()->user();
        $dataCabang = AksesCabang::where('user_id', $loggedInUser->user_id)->with('cabang')->get();
            if ($dataCabang->isEmpty()) {
                $allCabang = Cabang::all();
            }
    $allCabang = Cabang::all();

    $dataTransaksiDetail = TransaksiDetail::where('id_transaksi', NULL)
        ->with('transaksi')
        ->get();
    $dataUser = DataUser::all();

    // menu
    // $mainMenus = Data_Menu::where('menu_category', 'master menu')->get();
    //     $menuItemsWithSubmenus = [];
        
    //     foreach ($mainMenus as $mainMenu) {
    //         $subMenus = Data_Menu::where('menu_sub', $mainMenu->menu_id)
    //                             ->where('menu_category', 'sub menu')
    //                             ->orderBy('menu_position')
    //                             ->get();
    
    //         $menuItemsWithSubmenus[] = [
    //             'mainMenu' => $mainMenu,
    //             'subMenus' => $subMenus,
    //         ];
    //     }

    $user_id = auth()->user()->user_id; // Use 'user_id' instead of 'id'

            $user = DataUser::find($user_id);
            $role_id = $user->role_id;

            $menu_ids = RoleMenu::where('role_id', $role_id)->pluck('menu_id');

            $mainMenus = Data_Menu::where('menu_category', 'master menu')
                ->whereIn('menu_id', $menu_ids)
                ->get();

            $menuItemsWithSubmenus = [];

            foreach ($mainMenus as $mainMenu) {
                $subMenus = Data_Menu::where('menu_sub', $mainMenu->menu_id)
                    ->where('menu_category', 'sub menu')
                    ->whereIn('menu_id', $menu_ids)
                    ->orderBy('menu_position')
                    ->get();

                $menuItemsWithSubmenus[] = [
                    'mainMenu' => $mainMenu,
                    'subMenus' => $subMenus,
                ];
            }
    
    return view('transaksi.create', compact('dataJasa', 'dataKategori', 'dataTransaksiDetail', 'dataUser', 'selectedKategoriId','dataCustomer','dataCabang','allCabang','menuItemsWithSubmenus'));
}

public function search(Request $request, $id_transaksi)
    {
        $keyword = $request->input('keyword');
        $selectedKategoriId = $request->input('selectedKategori');

        // Query untuk mencari produk berdasarkan nama
        $dataJasa = Jasa::where('jenis_layanan', 'LIKE', "%$keyword%")
            ->when($selectedKategoriId, function ($query) use ($selectedKategoriId) {
                // If a category is selected, filter the products by the selected category
                $query->whereHas('kategori', function ($subQuery) use ($selectedKategoriId) {
                    $subQuery->where('id_kategori', $selectedKategoriId);
                });
            })
            ->with('kategori')
            ->get();

        // Get other required data
        $dataKategori = Kategori::all();
        // $dataAditional = AditionalProduk::all();
        $dataCustomer = Customer::all();
        // $loggedInUser = auth()->user();
        // $dataCabang = AksesCabang::where('user_id', $loggedInUser->user_id)->with('cabang')->get();
        // $dataCabang= Cabang::all();

        $loggedInUser = auth()->user();
        $dataCabang = AksesCabang::where('user_id', $loggedInUser->user_id)->with('cabang')->get();
            if ($dataCabang->isEmpty()) {
                $allCabang = Cabang::all();
            }
        $allCabang = Cabang::all();

        $dataTransaksiDetail = TransaksiDetail::where('id_transaksi', $id_transaksi)
            ->with('transaksi','jasa')
            ->get();
        $dataUser = DataUser::all();
        $dataTransaksi = Transaksi::find($request->id_transaksi);
       
        // menu
        // $mainMenus = Data_Menu::where('menu_category', 'master menu')->get();
        // $menuItemsWithSubmenus = [];
        
        // foreach ($mainMenus as $mainMenu) {
        //     $subMenus = Data_Menu::where('menu_sub', $mainMenu->menu_id)
        //                         ->where('menu_category', 'sub menu')
        //                         ->orderBy('menu_position')
        //                         ->get();

        //     $menuItemsWithSubmenus[] = [
        //         'mainMenu' => $mainMenu,
        //         'subMenus' => $subMenus,
        //     ];
        // }

        $user_id = auth()->user()->user_id; // Use 'user_id' instead of 'id'

            $user = DataUser::find($user_id);
            $role_id = $user->role_id;

            $menu_ids = RoleMenu::where('role_id', $role_id)->pluck('menu_id');

            $mainMenus = Data_Menu::where('menu_category', 'master menu')
                ->whereIn('menu_id', $menu_ids)
                ->get();

            $menuItemsWithSubmenus = [];

            foreach ($mainMenus as $mainMenu) {
                $subMenus = Data_Menu::where('menu_sub', $mainMenu->menu_id)
                    ->where('menu_category', 'sub menu')
                    ->whereIn('menu_id', $menu_ids)
                    ->orderBy('menu_position')
                    ->get();

                $menuItemsWithSubmenus[] = [
                    'mainMenu' => $mainMenu,
                    'subMenus' => $subMenus,
                ];
            }

        return view('transaksi.update', compact('dataJasa', 'dataKategori', 'dataTransaksiDetail', 'dataUser', 'selectedKategoriId','dataTransaksi', 'dataCustomer', 'dataCabang','allCabang','menuItemsWithSubmenus'));
    }





public function filter(Request $request)
{
    $selectedKategori = $request->input('filterKategori');
    $request->session()->put('selectedKategori', $selectedKategori);
    return back();
    
    // $selectedKategori = $request->input('filterKategori');
    // return back()->with('selectedKategori', $selectedKategori);
    // return redirect()->route('transaksi.create', ['selectedKategori' => $selectedKategori]);
}


public function filterJasa(Request $request, $id_transaksi)
{
    $keyword = $request->input('keyword');
    $selectedKategoriId = $request->input('selectedKategori');

    // Query untuk mencari produk berdasarkan nama dan kategori
    $dataJasa = Jasa::where('jenis_layanan', 'LIKE', "%$keyword%")
        ->when($selectedKategoriId, function ($query) use ($selectedKategoriId) {
            // If a category is selected, filter the products by the selected category
            $query->whereHas('kategori', function ($subQuery) use ($selectedKategoriId) {
                $subQuery->where('id_kategori', $selectedKategoriId);
            });
        })
        ->with('kategori')
        ->get();

    // Get other required data
    $dataKategori = Kategori::all();
    // $dataAditional = AditionalProduk::all();
    $dataTransaksiDetail = TransaksiDetail::where('id_transaksi', $id_transaksi)
        ->with('transaksi')
        ->get();
    $dataUser = DataUser::all();
    $dataCustomer = Customer::all();
    // $dataCabang = Cabang::all();
    // $loggedInUser = auth()->user();
    // $dataCabang = AksesCabang::where('user_id', $loggedInUser->user_id)->with('cabang')->get();

    $loggedInUser = auth()->user();
        $dataCabang = AksesCabang::where('user_id', $loggedInUser->user_id)->with('cabang')->get();
            if ($dataCabang->isEmpty()) {
                $allCabang = Cabang::all();
            }
        $allCabang = Cabang::all();

    $dataTransaksi = Transaksi::find($request->id_transaksi);

     // menu
    //  $mainMenus = Data_Menu::where('menu_category', 'master menu')->get();
    //  $menuItemsWithSubmenus = [];
     
    //  foreach ($mainMenus as $mainMenu) {
    //      $subMenus = Data_Menu::where('menu_sub', $mainMenu->menu_id)
    //                          ->where('menu_category', 'sub menu')
    //                          ->orderBy('menu_position')
    //                          ->get();
 
    //      $menuItemsWithSubmenus[] = [
    //          'mainMenu' => $mainMenu,
    //          'subMenus' => $subMenus,
    //      ];
    //  }

    $user_id = auth()->user()->user_id; // Use 'user_id' instead of 'id'

            $user = DataUser::find($user_id);
            $role_id = $user->role_id;

            $menu_ids = RoleMenu::where('role_id', $role_id)->pluck('menu_id');

            $mainMenus = Data_Menu::where('menu_category', 'master menu')
                ->whereIn('menu_id', $menu_ids)
                ->get();

            $menuItemsWithSubmenus = [];

            foreach ($mainMenus as $mainMenu) {
                $subMenus = Data_Menu::where('menu_sub', $mainMenu->menu_id)
                    ->where('menu_category', 'sub menu')
                    ->whereIn('menu_id', $menu_ids)
                    ->orderBy('menu_position')
                    ->get();

                $menuItemsWithSubmenus[] = [
                    'mainMenu' => $mainMenu,
                    'subMenus' => $subMenus,
                ];
            }

    return view('transaksi.update', compact('dataJasa', 'dataKategori', 'dataTransaksiDetail', 'dataUser', 'selectedKategoriId','dataTransaksi', 'dataCustomer', 'dataCabang','allCabang','menuItemsWithSubmenus'));
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id_transaksi)
        {
            $dataKategori = Kategori::all(); 

            $selectedKategoriId = $request->session()->get('selectedKategori');
            // $selectedKategoriId = $request->input('selectedKategori');

        // If a category is selected, filter the products by the selected category
        $selectedKategoriId = $request->input('selectedKategori', null);

        // If a category is selected, filter the products by the selected category
        if ($selectedKategoriId) {
            $dataJasa = Jasa::whereHas('kategori', function ($query) use ($selectedKategoriId) {
                $query->where('id_kategori', $selectedKategoriId);
            })->with('kategori')->get();
        } else {
            // If no category is selected, get all products
            $dataJasa = Jasa::with('kategori')->get();
        }

        // $dataAditional = AditionalProduk::all();
        $dataTransaksiDetail = TransaksiDetail::where('id_transaksi', NULL)->with('transaksi','jasa')->get();


            // $dataProduk = DataProduk::all();
            $dataTransaksiDetail = TransaksiDetail::where('id_transaksi', $id_transaksi)->get(); // Add a semicolon at the end of this line
            $dataTransaksi = Transaksi::where('id_transaksi', $id_transaksi)->first();
            $dataCustomer = Customer::all();
            // $dataCabang = Cabang::all();
            $loggedInUser = auth()->user();
            $dataCabang = AksesCabang::where('user_id', $loggedInUser->user_id)->with('cabang')->get();
            if ($dataCabang->isEmpty()) {
                $allCabang = Cabang::all();
            }
            $allCabang = Cabang::all();
            $dataJasa = Jasa::with('kategori')->get();

            // menu
            // $mainMenus = Data_Menu::where('menu_category', 'master menu')->get();
            // $menuItemsWithSubmenus = [];
            
            // foreach ($mainMenus as $mainMenu) {
            //     $subMenus = Data_Menu::where('menu_sub', $mainMenu->menu_id)
            //                         ->where('menu_category', 'sub menu')
            //                         ->orderBy('menu_position')
            //                         ->get();

            //     $menuItemsWithSubmenus[] = [
            //         'mainMenu' => $mainMenu,
            //         'subMenus' => $subMenus,
            //     ];
            // }

            $user_id = auth()->user()->user_id; // Use 'user_id' instead of 'id'

            $user = DataUser::find($user_id);
            $role_id = $user->role_id;

            $menu_ids = RoleMenu::where('role_id', $role_id)->pluck('menu_id');

            $mainMenus = Data_Menu::where('menu_category', 'master menu')
                ->whereIn('menu_id', $menu_ids)
                ->get();

            $menuItemsWithSubmenus = [];

            foreach ($mainMenus as $mainMenu) {
                $subMenus = Data_Menu::where('menu_sub', $mainMenu->menu_id)
                    ->where('menu_category', 'sub menu')
                    ->whereIn('menu_id', $menu_ids)
                    ->orderBy('menu_position')
                    ->get();

                $menuItemsWithSubmenus[] = [
                    'mainMenu' => $mainMenu,
                    'subMenus' => $subMenus,
                ];
            }
            return view('transaksi.update', compact('dataTransaksiDetail','dataJasa','dataTransaksi','dataKategori','selectedKategoriId','dataCustomer','dataCabang','allCabang','menuItemsWithSubmenus'));
        }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
    
        // Add new data to transaction details
        $jasa = Jasa::find($request->id_jasa);
        if ($jasa) {
            $transaksiDetail = TransaksiDetail::create([
                'id_transaksi' => $request->id_transaksi,
                'id_jasa' => $request->id_jasa,
                'jumlah_jasa' => $request->jumlah_jasa,
                'harga_perkg' => $jasa->harga_perkg,
                'diskon_jasa' => $jasa->diskon_jasa
                
            ]);
        } else {
            return back()->with('success', 'Transaksi Detail edited successfully');


        }
    
        return back()->with('success', 'Transaksi edited successfully');




    }
    
    

     public function updateTransaksi(Request $request){
        $totalHargaSetelahDiskon = $request->input('total_harga');
        $totalHargaSetelahDiskon = str_replace(['.', ','], '', $totalHargaSetelahDiskon);
        $totalKembalianInput  = $request->input('total_kembalian');
        $totalKembalianInput  = str_replace(['.', ','], '', $totalKembalianInput );
        $totalBayarInput   = $request->input('total_bayar');
        $totalBayarInput   = str_replace(['.', ','], '', $totalBayarInput  );

     
        DB::table('transaksi')->where('id_transaksi', $request->id_transaksi)->update([
            'id_customer' => $request->id_customer,
            'id_cabang' => $request->id_cabang,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'tanggal_selesai' => $request->tanggal_selesai,
            'total_harga' => $totalHargaSetelahDiskon,
            'total_bayar' => $totalBayarInput,
            'total_kembalian' => $totalKembalianInput,
            'status' => $request->status,
            'diskon_transaksi' => $request->diskon_transaksi,

            
    ]);

    return redirect()->route('transaksi.index')->with('success', 'Transaksi edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_transaksi)
{
    // Find the transaction data based on ID
    $dataTransaksi = Transaksi::findOrFail($id_transaksi);

    // Check if transaction details exist before attempting to delete them
    if ($dataTransaksi->transaksiDetail) {
        foreach ($dataTransaksi->transaksiDetail as $transaksiDetail) {
            // Check if transaksiDetailAditional relation exists before attempting to delete it
            // if ($transaksiDetail->transaksiDetailAditional) {
            //     $transaksiDetail->transaksiDetailAditional()->delete();
            // }
        }
        // Delete transaction details
        $dataTransaksi->transaksiDetail()->delete();
    }

    // Delete the transaction itself
    $dataTransaksi->delete();

    return redirect()->route('transaksi.index')->with('success', 'Terdelet');
}

public function showReceipt(Request $request)
{

    $dataToko = DataToko::all();
    $dataTransaksi = Transaksi::with('toko','produk','transaksiDetail')->where('id_transaksi', $request->id_transaksi)->get();
    return view('transaksi.resi' , compact('dataTransaksi','dataToko'));
    
}





// public function laporanTransaksi(Request $request) {
//     $query = Transaksi::with('user')->orderBy('id_transaksi', 'DESC');

//     $startDate = $request->input('start_date');
//     $endDate = $request->input('end_date');
//     $status = $request->input('status');

//     if ($startDate && $endDate) {
//         $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);
//         session(['start_date' => $startDate]);
//         session(['end_date' => $endDate]);
//     } else {
//         session()->forget('start_date');
//         session()->forget('end_date');
//     }

//     if ($status) {
//         $query->where('status', $status);
//         session(['status' => $status]);
//     } else {
//         session()->forget('status');
//     }

//     $totalBayar = $query->sum('total_bayar');
//     $totalKembalian = $query->sum('total_kembalian');


//     $dataTransaksi = $query->paginate(10);

//     return view('laporan.laporanTransaksi', compact('dataTransaksi','totalBayar','totalKembalian'));
// }

// baru
public function laporanTransaksi(Request $request) {
    $query = Transaksi::with('user')->orderBy('id_transaksi', 'DESC');

    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $status = $request->input('status');
    $cabangValue = $request->input('cabang', ''); // Gunakan '' sebagai nilai default

    if ($startDate && $endDate) {
        $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);
        session(['start_date' => $startDate]);
        session(['end_date' => $endDate]);
    } else {
        session()->forget('start_date');
        session()->forget('end_date');
    }

    if ($status) {
        $query->where('status', $status);
        session(['status' => $status]);
    } else {
        session()->forget('status');
    }

    if ($cabangValue) {
        $query->where('id_cabang', $cabangValue);
    }

    $totalBayar = $query->sum('total_bayar');
    $totalKembalian = $query->sum('total_kembalian');

    $dataTransaksi = $query->paginate(10);

    // Ambil data cabang untuk digunakan dalam opsi select
    // $loggedInUser = auth()->user(); // Get the authenticated user
    // $dataCabang = AksesCabang::where('user_id', $loggedInUser->user_id)
    //     ->with('cabang')
    //     ->get();
    
    $loggedInUser = auth()->user();
    $dataCabang = AksesCabang::where('user_id', $loggedInUser->user_id)
        ->with('cabang')
        ->get();

    $allCabang = Cabang::all();
    $selectedCabangId = $loggedInUser->cabang_id; 
    // $dataCabang = Cabang::all();

    // menu
    // $mainMenus = Data_Menu::where('menu_category', 'master menu')->get();
    //     $menuItemsWithSubmenus = [];
        
    //     foreach ($mainMenus as $mainMenu) {
    //         $subMenus = Data_Menu::where('menu_sub', $mainMenu->menu_id)
    //                             ->where('menu_category', 'sub menu')
    //                             ->orderBy('menu_position')
    //                             ->get();
    
    //         $menuItemsWithSubmenus[] = [
    //             'mainMenu' => $mainMenu,
    //             'subMenus' => $subMenus,
    //         ];
    //     }
            $user_id = auth()->user()->user_id; // Use 'user_id' instead of 'id'

            $user = DataUser::find($user_id);
            $role_id = $user->role_id;

            $menu_ids = RoleMenu::where('role_id', $role_id)->pluck('menu_id');

            $mainMenus = Data_Menu::where('menu_category', 'master menu')
                ->whereIn('menu_id', $menu_ids)
                ->get();

            $menuItemsWithSubmenus = [];

            foreach ($mainMenus as $mainMenu) {
                $subMenus = Data_Menu::where('menu_sub', $mainMenu->menu_id)
                    ->where('menu_category', 'sub menu')
                    ->whereIn('menu_id', $menu_ids)
                    ->orderBy('menu_position')
                    ->get();

                $menuItemsWithSubmenus[] = [
                    'mainMenu' => $mainMenu,
                    'subMenus' => $subMenus,
                ];
            }

    return view('laporan.laporanTransaksi', compact('dataTransaksi', 'totalBayar', 'totalKembalian', 'dataCabang', 'cabangValue', 'allCabang','selectedCabangId','menuItemsWithSubmenus'));
}






public function exportToPDF(Request $request)
{
    $paperSize = $request->input('paper_size', 'A4');

    $query = Transaksi::query(); // Create a query builder to apply filters

    // Apply filters based on request parameters
    if ($request->has('status')) {
        $query->where('status', $request->status);
    }

    if ($request->has('start_date') && $request->has('end_date')) {
        $query->whereBetween('tanggal_transaksi', [$request->start_date, $request->end_date]);
    }

    if ($request->has('cabang')) {
        $query->where('id_cabang', $request->cabang);
    }

    $totalBayar = $query->sum('total_bayar');
    $totalKembalian = $query->sum('total_kembalian');
    $dataCabang = Cabang::all();

    $dataTransaksi = $query->get(); // Get data without pagination

    $pdfOptions = new Options();
    $pdfOptions->set('defaultFont', 'Arial');
    // Set ukuran kertas sesuai dengan parameter yang diambil dari request
    $pdfOptions->set('size', $paperSize);

    $pdf = new Dompdf($pdfOptions);

    // Render the view with data and get the HTML content
    $htmlContent = View::make('laporan.eksportTransaksi', compact('dataTransaksi', 'totalBayar', 'totalKembalian', 'dataCabang'))->render();

    $pdf->loadHtml($htmlContent);

    $pdf->setPaper($paperSize, 'portrait'); // Atur ukuran kertas secara dinamis

    $pdf->render();

    return $pdf->stream('laporan-transaksi.pdf');
}

public function exportToExcel(Request $request)
{
    $query = Transaksi::with('user')->orderBy('id_transaksi', 'DESC');

    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');
    $status = $request->input('status');

    if ($startDate && $endDate) {
        $query->whereBetween('tanggal_transaksi', [$startDate, $endDate]);
    }

    if ($status) {
        $query->where('status', $status);
    }

    if ($request->has('cabang')) {
        $query->where('id_cabang', $request->cabang);
    }

    $dataCabang = Cabang::all();
    $dataTransaksi = $query->get();

    // Calculate the total of 'total_bayar' and 'total_kembalian'
    $totalBayar = $dataTransaksi->sum('total_bayar');
    $totalKembalian = $dataTransaksi->sum('total_kembalian');

    // Modify the data to exclude the 'id_transaksi' column and add the sequential number
    $dataWithNumber = [];
    $counter = 1;

    foreach ($dataTransaksi as $item) {
        $rowData = [
            $counter++, // Increment the counter and add the number as the first column
            $item->user->user_name ?? 'Unknown',
            $item->customer->nama_customer ?? 'Unknown',
            $item->cabang->nama_cabang ?? 'Unknown',
            $item->tanggal_transaksi,
            $item->tanggal_selesai,
            $item->status,
            $item->diskon_transaksi . '%',
            $item->total_harga,
            $item->total_bayar,
            $item->total_kembalian,
        ];

        $dataWithNumber[] = $rowData;
    }

    // Add a row for displaying the total
    $dataWithNumber[] = [
        'Total', // Empty cell for the number column
        '', // Label for the total row
        '', // Empty cells for the other columns that don't need to display the total
        '', // Empty cell
        '', // Empty cell
        '', // Empty cell
        '', // Empty cell
        '', // Empty cell
        '', // Empty cell
        $totalBayar, // Total of 'total_bayar'
        $totalKembalian, // Total of 'total_kembalian'
    ];

    // Convert the array data to a Laravel Collection
    $dataCollection = new Collection($dataWithNumber);

    // Export data to Excel using the TransaksiExport class
    return Excel::download(new TransaksiExport($dataTransaksi, $totalBayar, $totalKembalian, $dataCabang), 'laporan-transaksi.xlsx');
}

}

