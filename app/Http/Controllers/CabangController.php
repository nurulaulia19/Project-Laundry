<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\DataUser;
use App\Models\RoleMenu;
use App\Models\Data_Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $dataCabang = Cabang::orderBy('id_cabang', 'DESC')->paginate(10);
        // $dataKategori = Kategori::all();
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
        return view('cabang.index', compact('dataCabang','menuItemsWithSubmenus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataCabang = Cabang::all();

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
        return view('cabang.create', compact('dataCabang','menuItemsWithSubmenus'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = Cabang::insert([
            // 'id_customer' => $request->id_customer,
            'nama_cabang' => $request->nama_cabang,
            'alamat_cabang' => $request->alamat_cabang,
            'noHp_cabang' => $request->noHp_cabang,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        if($result){
            return redirect()->route('cabang.index')->with('success', 'Cabang insert successfully');
        }else{
            return $this->create();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit($id_cabang)
    {
        $dataCabang = Cabang::where('id_cabang', $id_cabang)->first();
        
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
        // $dataKategori = DB::table('data_menu')->select('*')->where('menu_category','master menu')->get();
        return view('cabang.update', compact('dataCabang','menuItemsWithSubmenus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_cabang){
        DB::table('cabang')->where('id_cabang', $id_cabang)->update([
            'nama_cabang' => $request->nama_cabang,
            'alamat_cabang' => $request->alamat_cabang,
            'noHp_cabang' => $request->noHp_cabang,
            'created_at' => now(),
            'updated_at' => now()
    ]);
    return redirect()->route('cabang.index')->with('success', 'Cabang edited successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_cabang)
    {
        $dataCabang = Cabang::where('id_cabang', $id_cabang);
        $dataCabang->delete();
        return redirect()->route('cabang.index')->with('success', 'Terdelet');
    }

    
    
}
