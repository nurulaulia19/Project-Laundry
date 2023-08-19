<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jasa extends Model
{
    use HasFactory;
    protected $table = 'jasa';
    protected $primaryKey = 'id_jasa';
    protected $fillable = [
            'id_jasa',
            'id_kategori',
            'jenis_layanan',
            'harga_perkg',
            'gambar',
            'diskon_jasa',
    ];

    public function transaksiDetail()
    {
        return $this->hasMany(TransaksiDetail::class, 'id_jasa', 'id_jasa');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_jasa', 'id_jasa');
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

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function aksescabang()
    {
        return $this->belongsTo(Cabang::class, 'id_ac', 'id_ac');
    }
}
