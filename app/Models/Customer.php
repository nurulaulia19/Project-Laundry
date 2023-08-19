<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public $table = "customer";
    protected $fillable = [
            'id_customer',
            'nama_customer',
            'alamat_customer',
            'noHp_customer',
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'id_customer', 'id_customer');
    }
}
