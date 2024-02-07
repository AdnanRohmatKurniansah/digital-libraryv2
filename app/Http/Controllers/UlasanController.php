<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanController extends Controller
{
    public function beriUlasan(Request $request)
    {
        if (Auth::check()) {
            $id_user = Auth::user()->id;
            $id_buku = $request->input('id_buku');

            $peminjamanExist = Peminjaman::where('id_user', $id_user)
            ->where('id_buku', $id_buku)
            ->whereIn('status', ['dipinjam', 'dikembalikan']) 
            ->exists();

            if (!$peminjamanExist) {
                return redirect()->back()->with('error', 'Anda hanya bisa beri ulasan ke buku yg sudah dipinjam.');
            }

            $ulasanExist = Ulasan::where('id_user', $id_user)
            ->where('id_buku', $id_buku)
            ->exists();

            if ($ulasanExist) {
                return redirect()->back()->with('error', 'Anda sudah memberikan ulasan');
            }

            $data = $request->validate([
                'rating' => 'required',
                'id_buku' => 'required',
                'ulasan' => 'required|max:255'
            ]);

            $data['id_user'] = $id_user;

            Ulasan::create($data);

            return redirect()->back()->with('success', 'Terimakasih sudah memberikan ulasan');
        } else {
            return redirect('/login')->with('logFirst', 'Anda harus login terlebih dahulu');
        }
    }                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                       
}
