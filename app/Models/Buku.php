<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function kategoris()
    {
        return $this->belongsToMany(Kategori::class, 'kategoribuku_relasi', 'id_buku', 'id_kategori');
    }

    public function scopeFilter($query, array $filters) 
    {
        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                 $query->where('judul', 'like', '%' . $search . '%');
             });
        }); 
    }

    public function koleksis() {
        return $this->hasMany(Koleksi::class);
    }

    public function ulasans() {
        return $this->hasMany(Ulasan::class, 'id_buku');
    }

    public function peminjamans() {
        return $this->hasMany(Peminjaman::class);
    }
}
