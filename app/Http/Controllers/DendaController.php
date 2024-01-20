<?php

namespace App\Http\Controllers;

use App\Models\Denda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DendaController extends Controller
{
    public function index() {
        return view('dashboard.denda.index', [
            'dendas' => Denda::orderBy('id', 'desc')->paginate(20)
        ]);
    }

    public function dendaku() {
        $user = Auth::user();
        $dendas = Denda::whereHas('peminjaman', function($query) use ($user) {
            $query->where('id_user', $user->id);
        })->paginate(20);
        return view('dashboard.peminjam.denda.index', [
            'dendas' => $dendas
        ]);
    }

    public function bayar(Request $request, Denda $denda) {
        $data = $request->validate([
            'dibayar' => 'required'
        ]);
    
        if ($data['dibayar'] == $denda->nominal) {
            $denda->update([
                'dibayar' => $data['dibayar'],
                'status' => 'lunas'
            ]);
        } else {
            $denda->update([
                'dibayar' => $data['dibayar'],
                'status' => 'blm-lunas'
            ]);
        }
    
        return back()->with('success', 'Denda berhasil dibayar');
    }
}
 