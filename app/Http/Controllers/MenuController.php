<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data_Menu;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\RoleMenu;

class MenuController extends Controller
{
    
     public function index() {
        $dataMenu = Data_Menu::leftJoin('data_menu AS menuSub', 'data_menu.menu_sub', '=', 'menuSub.menu_id')
            ->select('menuSub.menu_name AS submenu_name', 'data_menu.*')->paginate(10);
            
    
        return view('menu.index', compact('dataMenu'));
    }

    public function create(){
        $dataMenu = DB::table('data_menu')->select('*')->where('menu_category','master menu')->get();
        return view('menu.create', compact('dataMenu'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'menu_name' => 'required',
            'menu_link' => 'required',
            'menu_category' => 'required',
            'menu_position' => 'required|integer',
            'menu_sub' => 'nullable',
        ]);
        
        $result = Data_Menu::insert([
            'menu_id' => $request->menu_id,
            'menu_name' => $request->menu_name,
            'menu_link' => $request->menu_link,
            'menu_category' => $request->menu_category,
            'menu_sub' => $request->menu_sub,
            'menu_position' => $request->menu_position,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        if($result){
            return redirect()->route('menu.index')->with('success', 'Menu insert successfully');
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

    // public function tampilkandata($menu_id) {
    //     $dataMenu = Data_Menu::find($menu_id);
    // }


    public function edit($menu_id)
    {
    $menu = Data_Menu::where('menu_id', $menu_id)->first();
    $dataMenu = DB::table('data_menu')->select('*')->where('menu_category','master menu')->get();
    return view('menu.update', compact('dataMenu','menu'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    // public function edit($id)
    // {
        public function update(Request $request, $menu_id){
        DB::table('data_menu')->where('menu_id', $menu_id)->update([
            'menu_name' => $request->menu_name,
            'menu_link' => $request->menu_link,
            'menu_category' => $request->menu_category,
            'menu_sub' => $request->menu_sub,
            'menu_position' => $request->menu_position,
            'created_at' => now(),
            'updated_at' => now()
    ]);
    return redirect()->route('menu.index')->with('success', 'Menu edited successfully');
}
        
    //     $dataMenu = Data_Menu::where('menu_id', '=', $id)->first();
    //     return view('menu.update',compact('title','dataMenu'));
    //     // return view('menu.update');
    // }

    /**
     * Update the specified resource in storage.
     */
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($menu_id){
        $menu = Data_Menu::where('menu_id', $menu_id);
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Terdelet');
    }


    // public function getMenuData()
    // {
    //     // $menu_id = 1; // Example selected menu_id
    
    //     // $dataMenu = Data_Menu::all();
        
    // }
    




}
