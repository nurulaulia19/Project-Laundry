<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\DataToko;
use Illuminate\Http\Request;

class DataTokoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataToko = DataToko::orderBy('id_toko', 'ASC')->paginate(10);
        // $dataToko = DataToko::all();
        return view('toko.index', compact('dataToko'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataToko = DataToko::all();
        return view('toko.create', compact('dataToko'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'required|file|mimes:jpeg,jpg,png',
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::random(40) . '.' . $extension;
            // $fileName = $file->getClientOriginalName();
            $file->storeAs('public/photos', $fileName); 
        } else {
            $fileName = null;
        }

        $dataToko = new DataToko();
        $dataToko->id_toko = $request->id_toko;
        $dataToko->logo = $fileName;
        $dataToko->nama_toko = $request->nama_toko;
        $dataToko->no_hp = $request->no_hp;
        $dataToko->email = $request->email;
        $dataToko->alamat = $request->alamat;
        $dataToko->save();
    
        return redirect()->route('toko.index')->with('success', 'Data Toko inserted successfully');
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
    public function edit($id_toko)
    {
        $dataToko = DataToko::where('id_toko', $id_toko)->first();
        return view('toko.update', compact('dataToko'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_toko)
    {
        $validator = Validator::make($request->all(), [
            'gambar_produk' => 'file|mimes:jpeg,jpg,png'
            // Tambahkan aturan validasi lainnya sesuai kebutuhan
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $dataToko = DataToko::find($id_toko);
    
        if (!$dataToko) {
            // Produk dengan 'id_produk' yang dimaksud tidak ditemukan
            // Lakukan tindakan error handling atau tampilkan pesan kesalahan
            return redirect()->back()->with('error', 'data toko tidak ditemukan.');
        }
    
        $dataToko->nama_toko = $request->nama_toko;
        $dataToko->no_hp = $request->no_hp;
        $dataToko->email = $request->email;
        $dataToko->alamat = $request->alamat;
    
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $extension = $file->getClientOriginalExtension();
            $fileName = Str::random(40) . '.' . $extension;
            $file->storeAs('public/photos', $fileName);
            $dataToko->logo = $fileName;
        }
    
        $dataToko->save();
    
        return redirect()->route('toko.index')->with('success', 'Data Toko berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_toko)
    {
        $dataToko = DataToko::where('id_toko', $id_toko);
        $dataToko->delete();
        return redirect()->route('toko.index')->with('success', 'Terdelet');
    }
}
