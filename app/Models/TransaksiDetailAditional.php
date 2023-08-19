<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetailAditional extends Model
{
    use HasFactory;
    protected $table = "transaksi_detail_aditional";
    protected $primaryKey = 'id_tda';
    protected $fillable = [
            'id_tda',
            'id_transaksi_detail',
            'id_produk',
            'id_aditional',
            'harga_aditional',

            
    ];

    public function transaksiDetail()
    {
        return $this->belongsTo(TransaksiDetail::class, 'id_transaksi_detail', 'id_transaksi_detail');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
    }

    public function dataAditional()
    {
        return $this->belongsTo(AditionalProduk::class, 'id_aditional', 'id_aditional');
    }

    
    
}
