<?php

namespace App\Http\Controllers;

use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Kategori;
use App\Models\DataProduk;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\ProdukExport;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class DataProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $dataProduk = DataProduk::with('kategori')->orderBy('id_produk', 'DESC')->paginate(10);
        // $dataProduk = DataProduk::with('kategori')->get();
        return view('produk.index', compact('dataProduk'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataKategori = Kategori::all();
        $dataProduk = DataProduk::all();
        return view('produk.create', compact('dataKategori','dataProduk'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'gambar_produk' => 'required|file|mimes:jpeg,jpg,png',
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk'); // phpcs:ignore ..DetectUploadFil.Found
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::random(40) . '.' . $extension;
            // $fileName = $file->getClientOriginalName();
            $file->storeAs('public/photos', $fileName); 
        } else {
            $fileName = null;
        }

        $dataProduk = new DataProduk;
        $dataProduk->id_produk = $request->id_produk;
        $dataProduk->id_kategori = $request->id_kategori;
        $dataProduk->nama_produk = $request->nama_produk;
        $dataProduk->harga_produk = $request->harga_produk;
        $dataProduk->gambar_produk = $fileName;
        if ($request->has('diskon_produk')) {
            $dataProduk->diskon_produk = $request->diskon_produk;
        } else {
            $dataProduk->diskon_produk = 0;
        }
        $dataProduk->save();
    
        return redirect()->route('produk.index')->with('success', 'Produk inserted successfully');

       
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
    public function edit($id_produk)
    {
        $dataKategori = Kategori::all();
        $dataProduk = DataProduk::where('id_produk', $id_produk)->first();
        return view('produk.update', compact('dataKategori','dataProduk'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_produk)
    {
        $validator = Validator::make($request->all(), [
            'gambar_produk' => 'file|mimes:jpeg,jpg,png' // phpcs:ignore ..DetectWeakValidation.Found,..DetectWeakValidation.Found
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $dataProduk = DataProduk::find($id_produk);
    
        if (!$dataProduk) {
            // Produk dengan 'id_produk' yang dimaksud tidak ditemukan
            // Lakukan tindakan error handling atau tampilkan pesan kesalahan
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }
    
        $dataProduk->id_kategori = $request->id_kategori;
        $dataProduk->nama_produk = $request->nama_produk;
        $dataProduk->harga_produk = $request->harga_produk;
        $dataProduk->diskon_produk = $request->diskon_produk;
    
        if ($request->hasFile('gambar_produk')) {
            $file = $request->file('gambar_produk');
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::random(40) . '.' . $extension;
            $file->storeAs('public/photos', $fileName);
            $dataProduk->gambar_produk = $fileName;
        }
    
        $dataProduk->save();
    
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diubah.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_produk)
    {
        $dataProduk = DataProduk::where('id_produk', $id_produk);
        $dataProduk->delete();
        return redirect()->route('produk.index')->with('success', 'Terdelet');
    }

    public function laporanProduk(Request $request) {
        $query = DataProduk::with('kategori', 'transaksiDetail.transaksi')
            ->orderBy('id_produk', 'DESC');
    
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('ket_makanan');
    
        // Simpan data tanggal dan status ke dalam session jika diberikan dalam request
        if ($startDate && $endDate) {
            session(['start_date' => $startDate]);
            session(['end_date' => $endDate]);
        } else {
            session()->forget('start_date');
            session()->forget('end_date');
        }
    
        
        // Cek apakah status ada dalam request sebelum menyimpan dalam session
        if ($request->has('ket_makanan')) {
            session(['status' => $status]);
        } else {
            session()->forget('status');
        }
    
        // // Simpan nilai status dari session ke dalam variabel
        // $filteredStatus = session('status');
    
        // // Terapkan filter jika ada data tanggal dan status dalam session
        // if (session()->has('start_date') && session()->has('end_date')) {
        //     $query->whereHas('transaksiDetail.transaksi', function ($query) {
        //         $query->whereBetween('tanggal_transaksi', [session('start_date'), session('end_date')]);
        //             $query->where('ket_makanan', session('status'));
                
                    
        //     });
        // }
            
        // // }

        $filteredStatus = session('status');

        // Terapkan filter jika ada data tanggal dalam session
        if (session()->has('start_date') && session()->has('end_date')) {
            $query->whereHas('transaksiDetail.transaksi', function ($query) use ($filteredStatus) {
                $query->whereBetween('tanggal_transaksi', [session('start_date'), session('end_date')]);

                if ($filteredStatus === null) {
                    $query->where(function ($query) {
                        $query->orWhere('ket_makanan', 'dine in')
                            ->orWhere('ket_makanan', 'take away');
                    });
                } else {
                    $query->where('ket_makanan', session('status'));
                }
            });
        }
    
        $dataProduk = $query->paginate(10);
    
        return view('laporan.laporanProduk', compact('dataProduk'));
    }
 

    public function exportToPDF(Request $request)
    {
        $paperSize = $request->input('paper_size', 'A4');
    
        $query = DataProduk::query(); // Create a query builder to apply filters
    
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('ket_makanan');

        // Simpan data tanggal dan status ke dalam session jika diberikan dalam request
        if ($startDate && $endDate) {
            session(['start_date' => $startDate]);
            session(['end_date' => $endDate]);
        } else {
            session()->forget('start_date');
            session()->forget('end_date');
        }


        // Cek apakah status ada dalam request sebelum menyimpan dalam session
        if ($request->has('ket_makanan')) {
            session(['status' => $status]);
        } else {
            session()->forget('status');
        }

        $filteredStatus = session('status');

        // Terapkan filter jika ada data tanggal dalam session
        if (session()->has('start_date') && session()->has('end_date')) {
            $query->whereHas('transaksiDetail.transaksi', function ($query) use ($filteredStatus) {
                $query->whereBetween('tanggal_transaksi', [session('start_date'), session('end_date')]);

                if ($filteredStatus === null) {
                    $query->where(function ($query) {
                        $query->orWhere('ket_makanan', 'dine in')
                            ->orWhere('ket_makanan', 'take away');
                    });
                } else {
                    $query->where('ket_makanan', session('status'));
                }
            });
        }
        
            $dataProduk = $query->get();
    
            $grandTotalJumlahProduk = 0;
            $dataProduk = $query->get();
            
            foreach ($dataProduk as $item) {
                $totalJumlahProduk = 0; // Inisialisasi total jumlah produk untuk setiap produk
                foreach ($item->transaksiDetail as $transaksiDetail) {
                    if ($transaksiDetail->transaksi->tanggal_transaksi >= $startDate && $transaksiDetail->transaksi->tanggal_transaksi <= $endDate) {
                        if (!$status || ($status && $transaksiDetail->transaksi->ket_makanan == $status)) {
                            $totalJumlahProduk += $transaksiDetail->jumlah_produk;
                        }
                    }
                }
            
                // Tambahkan total jumlah produk ke grand total
                $grandTotalJumlahProduk += $totalJumlahProduk;
            }

            
            
            $pdfOptions = new Options();
            $pdfOptions->set('defaultFont', 'Arial');
            // Set ukuran kertas sesuai dengan parameter yang diambil dari request
            $pdfOptions->set('size', $paperSize);
            
            $pdf = new Dompdf($pdfOptions);
            
            // Render the view with data and get the HTML content
            $htmlContent = View::make('laporan.eksportProduk', compact('dataProduk', 'grandTotalJumlahProduk'))->render();
            
            $pdf->loadHtml($htmlContent);
            
            $pdf->setPaper($paperSize, 'portrait'); // Atur ukuran kertas secara dinamis
            
            $pdf->render();
            
            
            return $pdf->stream('laporan-produk.pdf');
    }
    


public function exportToExcel(Request $request)
{
    
    $query = DataProduk::with('kategori', 'transaksiDetail.transaksi')
    ->orderBy('id_produk', 'DESC');

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $status = $request->input('ket_makanan');

        // Simpan data tanggal dan status ke dalam session jika diberikan dalam request
        if ($startDate && $endDate) {
            session(['start_date' => $startDate]);
            session(['end_date' => $endDate]);
        } else {
            session()->forget('start_date');
            session()->forget('end_date');
        }


        // Cek apakah status ada dalam request sebelum menyimpan dalam session
        if ($request->has('ket_makanan')) {
            session(['status' => $status]);
        } else {
            session()->forget('status');
        }

        $filteredStatus = session('status');

        // Terapkan filter jika ada data tanggal dalam session
        if (session()->has('start_date') && session()->has('end_date')) {
            $query->whereHas('transaksiDetail.transaksi', function ($query) use ($filteredStatus) {
                $query->whereBetween('tanggal_transaksi', [session('start_date'), session('end_date')]);

                if ($filteredStatus === null) {
                    $query->where(function ($query) {
                        $query->orWhere('ket_makanan', 'dine in')
                            ->orWhere('ket_makanan', 'take away');
                    });
                } else {
                    $query->where('ket_makanan', session('status'));
                }
            });
        }


            $dataProduk = $query->get();

    // Modify the data to exclude the 'id_transaksi' column and add the sequential number
    $dataWithNumber = [];
    $counter = 1;
    $grandTotalJumlahProduk = 0;

    foreach ($dataProduk as $item) {
        $totalJumlahProduk = 0; // Inisialisasi total jumlah produk untuk setiap produk
        foreach ($item->transaksiDetail as $transaksiDetail) {
            if ($transaksiDetail->transaksi->tanggal_transaksi >= $startDate && $transaksiDetail->transaksi->tanggal_transaksi <= $endDate) {
                if (!$status || ($status && $transaksiDetail->transaksi->ket_makanan == $status)) {
                    $totalJumlahProduk += $transaksiDetail->jumlah_produk;
                }
            }
        }

        $rowData = [
            $counter++, // Increment the counter and add the number as the first column
            $item->kategori->nama_kategori,
            $item->nama_produk,
            $totalJumlahProduk, // Total jumlah produk
            
        ];

        $dataWithNumber[] = $rowData;
        $grandTotalJumlahProduk += $totalJumlahProduk;
    }

    $dataWithNumber[] = [
        'Grand Total', // Empty cell for the number column
        '', // Label for the total row
        '', 
        $grandTotalJumlahProduk,
    ];

    // Convert the array data to a Laravel Collection
    $dataCollection = new Collection($dataWithNumber);

    // Export data to Excel using the ProdukExport class
    // return Excel::download(new ProdukExport($dataCollection), 'laporan-produk.xlsx');
    return Excel::download(new ProdukExport($dataProduk), 'laporan-produk.xlsx');
    // return Excel::download(new TransaksiExport($dataTransaksi, $totalBayar, $totalKembalian), 'laporan-transaksi.xlsx');

}

    
}