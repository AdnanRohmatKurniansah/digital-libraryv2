<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
// use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.buku.index', [
            'bukus' => Buku::orderBy('id', 'desc')->paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.buku.create', [
            'kategoris' => Kategori::orderBy('nama', 'asc')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|min:3|max:255',
            'id_kategories' => ['required', 'array'],
            'deskripsi' => 'required|max:255',
            'penulis'  => 'required|max:100',
            'penerbit'  => 'required|max:100',
            'sampul' => 'image|file|max:2048',
            'jumlah' => 'required',
            'tahun_terbit' => 'required',
        ]);

        if($request->file('sampul')) {
            $uploadedFileUrl = Cloudinary::upload($request->file('sampul')->getRealPath(), [
                'folder' => 'digital-library/sampul_buku'
            ])->getSecurePath();
            $data['sampul'] = $uploadedFileUrl;
        } 

        if ($buku = Buku::create($data)) {
            $buku->kategoris()->sync($data['id_kategories']);
        }

        return redirect('/dashboard/buku')->with('success', 'Buku baru berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {   $url = Crypt::decryptString($id);
        $buku = Buku::findOrFail($url);
        return view('dashboard.buku.edit', [
            'buku' => $buku,
            'kategoris' => Kategori::orderBy('nama', 'asc')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        $data = $request->validate([
            'judul' => 'required|min:3|max:255',
            'id_kategories' => ['required', 'array'],
            'deskripsi' => 'required|max:255',
            'penulis'  => 'required|max:100',
            'penerbit'  => 'required|max:100',
            'sampul' => 'image|file|max:2048',
            'jumlah' => 'required',
            'tahun_terbit' => 'required',
        ]);

        if ($request->file('sampul')) {
            if ($buku->sampul) {
                $publicId = basename($buku->sampul, '.' . pathinfo($buku->sampul)['extension']);
                Cloudinary::destroy('digital-library/sampul_buku/' . $publicId);
            }
            $uploadedFileUrl = Cloudinary::upload($request->file('sampul')->getRealPath(), [
                'folder' => 'digital-library/sampul_buku'
            ])->getSecurePath();
            $data['sampul'] = $uploadedFileUrl;
        }

        $buku->update($data);
        $buku->kategoris()->sync($data['id_kategories']);

        return redirect('/dashboard/buku')->with('update', 'Buku berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {   
        $kategoribukus = $buku->kategoris;
    
        foreach ($kategoribukus as $kategori) {
            $kategori->bukus()->detach($buku->id);
        }

        if ($buku->sampul) {
            $publicId = basename($buku->sampul, '.' . pathinfo($buku->sampul)['extension']);
            Cloudinary::destroy('digital-library/sampul_buku/' . $publicId);
        }
        
        $buku->delete();
        return redirect('/dashboard/buku')->with('success', 'Buku berhasil dihapus');
    }
}
