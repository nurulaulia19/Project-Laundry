<?php

namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\Data_Menu;
use App\Models\RoleMenu;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataRole = Role::orderBy('role_id', 'DESC')->paginate(10);
        $roles = Role::with('roleMenus')->get();
        // $dataRole = Role::all();
        return view('role.index', compact('dataRole', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $dataRole = Role::all();
        $dataMenu = Data_Menu::all();
        return view('role.create', compact('dataMenu','dataRole'));
    }
    
    public function store(Request $request)
{
    // $dataRole = Role::crea
    $dataRole = Role::create([
        'role_name' => $request->role_name,
    ]);

    // dd($dataRole);
    $menu_id=$request->menu_id;
    foreach ($menu_id as $id) {
        RoleMenu::create([
            'role_id' => $dataRole->id,
            'menu_id' => $id
        ]);
    }

    return redirect()->route('role.index')->with('error', 'Failed to insert role');
}
    
    /**
     * Store a newly created resource in storage.
     */

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
    // public function edit(string $id)
    // {
    //     //
    // }

    public function edit($role_id)
{
    // $dataRole = Role::find('role_id');
    $selectedMenuIds = RoleMenu::where('role_id', $role_id)->pluck('menu_id')->toArray();
    $dataMenu = Data_Menu::all();
    $dataRole = Role::where('role_id', $role_id)->first();
    return view('role.update', compact('dataMenu', 'dataRole', 'selectedMenuIds'));
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $role_id)
        {
         //perintah untuk delete data_role_menu berdasarkan role id
        RoleMenu::where('role_id', $role_id)->delete();
        DB::table('data_role')->where('role_id', $role_id)->update([
            'role_name' => $request->role_name,
            'created_at' => now(),
            'updated_at' => now()

    ]);
    $menu_id=$request->menu_id;
    foreach ($menu_id as $id) {
        RoleMenu::create([
            'role_id' => $role_id,
            'menu_id' => $id
        ]);
    }

    return redirect()->route('role.index')->with('success', 'Menu edited successfully');

}

    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($role_id){
        $menu = Role::where('role_id', $role_id);
        $menu->delete();
        $dataRoleMenu = RoleMenu::where('role_id', $role_id);
        $dataRoleMenu->delete();
        return redirect()->route('role.index')->with('success', 'Terdelet');
    }
}
