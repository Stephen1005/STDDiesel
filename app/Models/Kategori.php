<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    protected $guarded = [];
    protected $fillable = [
        'nama_kategori',
        'id_kategori',
        // kolom lainnya
    ];
    public function produk()
    {
        return $this->hasMany(Produk::class, 'id_kategori');
    }
}
