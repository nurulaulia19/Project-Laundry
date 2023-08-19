<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    public $table = "kategori";
    protected $fillable = [
            'id_kategori',
            'nama_kategori',
    ];

    public function dataProduk()
    {
        return $this->hasMany(DataProduk::class, 'id_kategori', 'id_kategori');
    }

}
