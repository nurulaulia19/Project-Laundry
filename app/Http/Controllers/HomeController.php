<?php

namespace App\Http\Controllers;

use App\Models\Verifytoken;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Transaksi;
use App\Models\DataProduk;
use App\Models\Kategori;
use App\Models\AditionalProduk;
use App\Models\Jasa;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $startDate = Carbon::now()->startOfMonth();
        $endDate = Carbon::now()->endOfMonth();
    
        // Membuat array data tanggal untuk seluruh bulan
        $labels = [];
        $currentDate = $startDate->copy();
        while ($currentDate <= $endDate) {
            $labels[] = $currentDate->format('d M Y');
            $currentDate->addDay();
        }
    
        // Mengambil data transaksi dari database
        $transaksiData = Transaksi::select(
            DB::raw('DATE(tanggal_transaksi) as tanggal'),
            DB::raw('COUNT(id_transaksi) as total')
        )
        ->whereBetween('tanggal_transaksi', [$startDate, $endDate])
        ->groupBy('tanggal')
        ->orderBy('tanggal')
        ->get();
    
        // Membuat array data total transaksi berdasarkan tanggal
        $totals = [];
        foreach ($labels as $label) {
            $tanggal = Carbon::createFromFormat('d M Y', $label)->format('Y-m-d');
            $transaksi = $transaksiData->firstWhere('tanggal', $tanggal);
            $totals[] = $transaksi ? $transaksi->total : 0;
        }

       
    
        $jumlahTransaksi = Transaksi::count();
        $jumlahJasa = Jasa::count();
        $jumlahKategori = Kategori::count();
        $totalHargaProduk = Transaksi::sum('total_harga');
    
        return view('home.index', compact('labels', 'totals', 'jumlahTransaksi', 'jumlahJasa', 'jumlahKategori','totalHargaProduk'));
        // return view('home.index');

    //     $get_user = User::where('email',auth()->user()->email)->first();
    //     if($get_user->is_activated == 1){
    //         return view('home');
    //     }else{
    //         return redirect('/verify-account');
    //     }
        
    // }

    // public function verifyaccount(){
    //     return view('opt_verification');
    }

    // public function useractivation(Request $request){
    //     $get_token = $request->token;
    //     $get_token = Verifytoken::where('token',$get_token)->first();

    //     if($get_token){
    //         $get_token->is_activated = 1;
    //         $get_token->save();
    //         $user = User::where('email',$get_token->email)->first();
    //         $user->is_activated = 1;
    //         $user->save();
    //         $getting_token = Verifytoken::where('token',$get_token->token)->first();
    //         // $getting_token->delete();
    //         return redirect('/home')->with('activated','Your Account has been activated successfully');
    //     } else{
    //         return redirect('/verify-account')->with('incorrect','Your OTP is invalid please check your email once');
    //     }
    // }
}
