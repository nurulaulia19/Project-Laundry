<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;
    protected $table = "transaksi_detail";
    protected $primaryKey = 'id_transaksi_detail';
    protected $fillable = [
            'id_transaksi_detail',
            'id_transaksi',
            'id_jasa',
            'jumlah_jasa',
            'harga_perkg',
            'diskon_jasa',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi', 'id_transaksi');
    }

    public function produk()
    {
        return $this->belongsTo(DataProduk::class, 'id_produk', 'id_produk');
    }

    public function jasa()
    {
        return $this->belongsTo(Jasa::class, 'id_jasa', 'id_jasa');
    }

    public function transaksiDetailAditional()
    {
        return $this->hasMany(TransaksiDetailAditional::class, 'id_transaksi_detail', 'id_transaksi_detail')->with('dataAditional');
    }

    public function AditionalProduk()
    {
        return $this->hasMany(AditionalProduk::class, 'id_aditional', 'id_aditional');
    }


    public function setIdTransaksiAttribute($value)
    {
        $this->attributes['id_transaksi'] = $value ?: null;
    }

    
    // public function roleMenus()
    // {
    //     return $this->hasMany(RoleMenu::class, 'role_id', 'role_id')->with('dataMenu');
    // }
}
