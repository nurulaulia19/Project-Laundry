<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
use App\Models\DataUser;
use App\Models\RoleMenu;
use App\Models\Data_Menu;
use App\Models\AksesCabang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AksesCabangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataAksesCabang = AksesCabang::with('cabang','user')->get();
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
        return view('aksescabang.index', compact('dataAksesCabang','menuItemsWithSubmenus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataAksesCabang = AksesCabang::all();
        $dataCabang = Cabang::all(); 
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
        return view('aksescabang.create', compact('dataAksesCabang','dataCabang','dataUser','menuItemsWithSubmenus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = AksesCabang::insert([
            // 'id_customer' => $request->id_customer,
            'id_cabang' => $request->id_cabang,
            'user_id' => $request->user_id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        if($result){
            return redirect()->route('aksescabang.index')->with('success', 'Akses Cabang insert successfully');
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_ac)
    {
        $dataAksesCabang = AksesCabang::where('id_ac', $id_ac)->first();
        $dataCabang = Cabang::all();
        $dataUser = DataUser::all();
        // $dataKategori = DB::table('data_menu')->select('*')->where('menu_category','master menu')->get();

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
        return view('aksescabang.update', compact('dataAksesCabang','dataCabang','dataUser','menuItemsWithSubmenus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_ac){
        DB::table('akses_cabang')->where('id_ac', $id_ac)->update([
            'id_cabang' => $request->id_cabang,
            'user_id' => $request->user_id,
            'created_at' => now(),
            'updated_at' => now()
    ]);
    return redirect()->route('aksescabang.index')->with('success', 'Akses Cabang edited successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_ac)
    {
        $dataAksesCabang = AksesCabang::where('id_ac', $id_ac);
        $dataAksesCabang->delete();
        return redirect()->route('aksescabang.index')->with('success', 'Terdelet');
    }
}
