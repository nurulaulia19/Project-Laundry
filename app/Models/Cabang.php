<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cabang extends Model
{
    use HasFactory;
    public $table = "cabang";
    protected $fillable = [
            'id_cabang',
            'nama_cabang',
            'alamat_cabang',
            'noHp_cabang',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_cabang', 'id_cabang');
    }

    public function aksesCabang()
    {
        return $this->hasMany(AksesCabang::class, 'id_cabang', 'id_cabang');
    }

    public function jasa()
    {
        return $this->hasMany(AksesCabang::class, 'id_cabang', 'id_cabang');
    }

}
