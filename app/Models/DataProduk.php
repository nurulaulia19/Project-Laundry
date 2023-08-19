<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataProduk extends Model
{
    use HasFactory;
    protected $table = "data_produk";
    protected $primaryKey = 'id_produk';
    protected $fillable = [
            'id_produk',
            'id_kategori',
            'nama_produk',
            'harga_produk',
            'gambar_produk',
            'diskon_produk',
    ];

    public function transaksiDetail()
    {
        return $this->hasMany(TransaksiDetail::class, 'id_produk', 'id_produk');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    // public function aditionalProduk()
    // {
    //     return $this->hasMany(AditionalProduk::class, 'id_produk', 'id_produk');
    // }

    public function transaksiDetailAditional()
    {
        return $this->hasMany(TransaksiDetailAditional::class, 'id_produk', 'id_produk');
    }
}
