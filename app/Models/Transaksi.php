<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = "transaksi";
    protected $primaryKey = "id_transaksi";
    protected $fillable = [
            'id_transaksi',
            'user_id',
            'id_customer',
            'id_cabang',
            'tanggal_transaksi',
            'tanggal_selesai',
            'total_harga',
            'total_bayar',
            'total_kembalian',
            'status',
            'diskon_transaksi',
    ];

    public function user()
    {
        return $this->belongsTo(DataUser::class, 'user_id', 'user_id');
    }

    public function transaksiDetail()
    {
        return $this->hasMany(TransaksiDetail::class, 'id_transaksi', 'id_transaksi');
    }

    public function produk()
    {
        return $this->belongsTo(DataProduk::class, 'id_produk', 'id_produk');
    }

    public function transaksiDetailAditional()
    {
        return $this->hasMany(TransaksiDetailAditional::class, 'id_transaksi_detail', 'id_transaksi_detail');
    }

    public function toko()
    {
        return $this->belongsTo(DataToko::class, 'id_toko', 'id_toko');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    
    public function jasa()
    {
        return $this->belongsTo(Jasa::class, 'id_jasa', 'id_jasa');
    }

    public function aksesCabang()
    {
        return $this->belongsTo(AksesCabang::class, 'id_ac', 'id_ac');
    }

    
}
