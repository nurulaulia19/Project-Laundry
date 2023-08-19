<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $dataKategori = Kategori::orderBy('id_kategori', 'DESC')->paginate(10);
        // $dataKategori = Kategori::all();
        return view('kategori.index', compact('dataKategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataKategori = Kategori::all();
        return view('kategori.create', compact('dataKategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = Kategori::insert([
            'id_kategori' => $request->id_kategori,
            'nama_kategori' => $request->nama_kategori,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        if($result){
            return redirect()->route('kategori.index')->with('success', 'Kategori insert successfully');
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
    public function edit($id_kategori)
    {
        $dataKategori = Kategori::where('id_kategori', $id_kategori)->first();
        // $dataKategori = DB::table('data_menu')->select('*')->where('menu_category','master menu')->get();
        return view('kategori.update', compact('dataKategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_kategori){
        DB::table('kategori')->where('id_kategori', $id_kategori)->update([
            'nama_kategori' => $request->nama_kategori,
            'created_at' => now(),
            'updated_at' => now()
    ]);
    return redirect()->route('kategori.index')->with('success', 'Kategori edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_kategori)
    {
        $dataKategori = Kategori::where('id_kategori', $id_kategori);
        $dataKategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Terdelet');
    }
}
