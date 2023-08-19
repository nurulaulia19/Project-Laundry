<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $dataCustomer = Customer::orderBy('id_customer', 'DESC')->paginate(10);
        // $dataKategori = Kategori::all();
        return view('customer.index', compact('dataCustomer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataCustomer = Customer::all();
        return view('customer.create', compact('dataCustomer'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $result = Customer::insert([
            // 'id_customer' => $request->id_customer,
            'nama_customer' => $request->nama_customer,
            'alamat_customer' => $request->alamat_customer,
            'noHp_customer' => $request->noHp_customer,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        if($result){
            return redirect()->route('customer.index')->with('success', 'Customer insert successfully');
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
    public function edit($id_customer)
    {
        $dataCustomer = Customer::where('id_customer', $id_customer)->first();
        // $dataKategori = DB::table('data_menu')->select('*')->where('menu_category','master menu')->get();
        return view('customer.update', compact('dataCustomer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_customer){
        DB::table('customer')->where('id_customer', $id_customer)->update([
            'nama_customer' => $request->nama_customer,
            'alamat_customer' => $request->alamat_customer,
            'noHp_customer' => $request->noHp_customer,
            'created_at' => now(),
            'updated_at' => now()
    ]);
    return redirect()->route('customer.index')->with('success', 'Customer edited successfully');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_customer)
    {
        $dataCustomer = Customer::where('id_customer', $id_customer);
        $dataCustomer->delete();
        return redirect()->route('customer.index')->with('success', 'Terdelet');
    }
}
