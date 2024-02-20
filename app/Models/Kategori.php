<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function bukus()
    {
        return $this->belongsToMany(Buku::class, 'kategoribuku_relasi', 'id_kategori', 'id_buku');
    }
}
