<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Denda;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class PeminjamanController extends Controller
{
    public function peminjaman() {
        return view('dashboard.peminjaman.index', [
            'peminjamans' => Peminjaman::orderBy('id', 'desc')
                ->paginate(20)
        ]);
    }

    public function detailPeminjaman($id) {
        $url = Crypt::decryptString($id);
        $peminjaman = Peminjaman::findOrFail($url);
        return view('dashboard.peminjaman.detail', [
            'peminjaman' => $peminjaman
        ]);
    }

    public function peminjamanku() {
        return view('dashboard.peminjam.peminjamanku.index', [
            'peminjamans' => Peminjaman::where('id_user', Auth::user()->id)
                ->paginate(20)
        ]);
    }

    public function pinjam (Request $request) {
        $id_user = Auth::user()->id;

        $data = $request->validate([
            'id_buku' => 'required'
        ]);

        $jumlahDipinjam = Peminjaman::where('id_user', $id_user)
            ->where('status', '!=', 'dikembalikan')
            ->count();

        if ($jumlahDipinjam >= 2) {
            return back()->with('error', 'Tolong kembalikan buku sebelumnya');
        }

        $code = $this->generateCode();
        
        while (Peminjaman::where('kode', $code)->exists()) {
            $code = $this->generateCode();
        }

        $data['tgl_kembali'] = now()->addWeek();
        $data['id_user'] = $id_user;
        $data['kode'] = $code;

        $peminjaman = Peminjaman::create($data);

        return redirect('/dashboard/peminjaman/' . Crypt::encryptString($peminjaman->id))->with('success', 'Tunjukkan kode ke petugas perpustakaan');
    }

    public function inputKodePinjam(Request $request) {
        $data = $request->validate([
            'kode' => 'required'
        ]);

        $peminjaman = Peminjaman::where('kode', $data['kode'])
            ->where('status', 'diproses')
            ->first();

        if (!$peminjaman) {
            return back()->with('error', 'Peminjaman tidak ditemukan');
        }

        $peminjaman->update([
            'status' => 'dipinjam'
        ]);

        $buku = Buku::where('id', $peminjaman->id_buku)->first();
        $buku->update([
            'jumlah' => $buku->jumlah - 1
        ]);

        return redirect('/dashboard/peminjaman/' . Crypt::encryptString($peminjaman->id))->with('success', 'Berhasil melakukan peminjaman');
    }

    public function inputKodePengembalian(Request $request) {
        $data = $request->validate([
            'kode' => 'required'
        ]);

        $peminjaman = Peminjaman::where('kode', $data['kode'])
            ->where('status', 'dipinjam')
            ->first();

        if (!$peminjaman) {
            return back()->with('error', 'Peminjaman tidak ditemukan');
        }

        $peminjaman->update([
            'status' => 'dikembalikan',
            'dikembalikan' => now()
        ]);

        $buku = Buku::where('id', $peminjaman->id_buku)->first();
        $buku->update([
            'jumlah' => $buku->jumlah + 1
        ]);

        if ($peminjaman->dikembalikan > $peminjaman->tgl_kembali) {
            $selisihHari = Carbon::parse($peminjaman->dikembalikan)->diffInDays($peminjaman->tgl_kembali);
            $nominalDenda = 1000 * $selisihHari;
            Denda::create([
                'id_peminjaman' => $peminjaman->id,
                'nominal' => $nominalDenda
            ]);
            return redirect('/dashboard/denda')->with('success', 'Berhasil melakukan pengembalian');
        }

        return redirect('/dashboard/peminjaman/' . Crypt::encryptString($peminjaman->id))->with('success', 'Berhasil melakukan pengembalian');
    }

    public function generateLaporan(Request $request) {
        $data = $request->validateWithBag('generateLaporan', [
            'dari' => 'required',
            'sampai' => 'required'
        ]);

    
        $peminjamans = Peminjaman::whereBetween('created_at', [$data['dari'], $data['sampai']])->get();
    
        if ($peminjamans->count() < 1) {
            return back()->with('error', 'Tidak ada peminjaman dlm rentang waktu tersebut');
        }
    
        $pdf = Pdf::loadView('dashboard.laporan', [
            'peminjamans' => $peminjamans
        ])->setOptions(['defaultFont' => 'sans-serif']);
    
        return $pdf->stream('laporan.pdf');
    }

    public function generateCode() {
        return str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);
    }
}
