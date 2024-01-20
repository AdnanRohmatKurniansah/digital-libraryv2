<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function buku() {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    public function denda() {
        return $this->hasOne(Denda::class);
    }
}
