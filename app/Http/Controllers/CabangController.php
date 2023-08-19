<?php

namespace App\Http\Controllers;

use App\Models\Cabang;
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
        return view('cabang.index', compact('dataCabang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataCabang = Cabang::all();
        return view('cabang.create', compact('dataCabang'));
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
        
        // $dataKategori = DB::table('data_menu')->select('*')->where('menu_category','master menu')->get();
        return view('cabang.update', compact('dataCabang'));
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
