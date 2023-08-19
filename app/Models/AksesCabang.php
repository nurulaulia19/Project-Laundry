<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AksesCabang extends Model
{
    use HasFactory;
    public $table = "akses_cabang";
    protected $fillable = [
            'id_ac',
            'id_cabang',
            'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(DataUser::class, 'user_id', 'user_id');
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_ac', 'id_ac');
    }

    public function cabang()
    {
        return $this->belongsTo(Cabang::class, 'id_cabang', 'id_cabang');
    }

    public function aksescabang()
    {
        return $this->hasMany(AksesCabang::class, 'id_ac', 'id_ac');
    }


}
