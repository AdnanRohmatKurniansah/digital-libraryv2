<?php

namespace App\Http\Controllers;

use App\Models\Koleksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KoleksiController extends Controller
{
    public function koleksi() {
        $id_user = Auth::user()->id;
        return view('dashboard.peminjam.koleksi.index', [
            'koleksis' => Koleksi::where('id_user', $id_user)->paginate(20)
        ]);
    }

    public function tambahKoleksi(Request $request) {
        if (Auth::check()) {
            $id_user = Auth::user()->id;
            $id_buku = $request->input('id_buku');

            $bukuExist = Koleksi::where('id_buku', $id_buku)
            ->exists();

            if ($bukuExist) {
                return back()->with('error', 'Anda sudah memasukkannya ke koleksi');
            }

            $data = $request->validate([
                'id_buku' => 'required',
            ]);

            $data['id_user'] = $id_user;

            Koleksi::create($data);

            return back()->with('success', 'Buku dimasukkan ke koleksi');
        } else {
            return redirect('/login')->with('logFirst', 'Anda harus login terlebih dahulu');
        }
    }

    public function hapusKoleksi(Koleksi $koleksi) {
        $koleksi->delete();
        return redirect('/dashboard/koleksi')->with('success', 'Buku dihapus dari koleksi');
    }
}
