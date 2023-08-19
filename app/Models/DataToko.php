<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataToko extends Model
{
    use HasFactory;
    protected $table = 'data_toko';
    protected $primaryKey = 'id_toko';
    protected $fillable = [
            'id_toko',
            'logo',
            'nama_toko',
            'no_hp',
            'email',
            'alamat'
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_toko', 'id_toko');
    }
}
