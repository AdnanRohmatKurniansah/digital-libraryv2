<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\DendaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KoleksiController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UlasanController;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Ulasan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/listbuku', function() {
    return view('ListBuku', [
        'bukus' => Buku::orderBy('id', 'desc')->filter(request(['search']))->paginate(20)
    ]);
});

Route::get('/detailbuku/{id}', function($id) {
    $url = Crypt::decryptString($id);
    $buku = Buku::findOrFail($url);
    return view('DetailBuku', [
        'buku' => $buku,
        'ulasans' => Ulasan::where('id_buku', $buku->id)->get()
    ]);
});


Route::middleware(['auth', 'verified'])->prefix('dashboard')->group(function() {
    Route::get('/peminjaman/{id}', [PeminjamanController::class, 'detailPeminjaman']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::middleware('AdminNotAllowed')->group(function() {
        Route::get('/koleksi', [KoleksiController::class, 'koleksi']);
        Route::post('/koleksi', [KoleksiController::class, 'tambahKoleksi']);
        Route::delete('/koleksi/{koleksi}', [KoleksiController::class, 'hapusKoleksi']);
        Route::get('/peminjam/peminjamanku', [PeminjamanController::class, 'peminjamanku']);
        Route::post('/peminjaman', [PeminjamanController::class, 'pinjam']);
        Route::post('/ulasan', [UlasanController::class, 'beriUlasan']);
        Route::get('/dendaku', [DendaController::class, 'dendaku']);
    });
    Route::middleware('PeminjamNotAllowed')->group(function() {
        Route::get('/', function () {
            return view('dashboard.dashboard', [
                'peminjamans' => Peminjaman::select(DB::raw('DATE_FORMAT(created_at, "%M") AS date'), DB::raw('COUNT(*) AS count'))
                ->groupBy(DB::raw('DATE_FORMAT(created_at, "%M")'))
                ->orderBy(DB::raw('DATE_FORMAT(created_at, "%M")'))
                ->get()
            ]);
        })->name('dashboard');
        Route::resource('/buku/kategori', KategoriController::class);
        Route::get('/buku', [BukuController::class, 'index']);
        Route::get('/buku/create', [BukuController::class, 'create']);
        Route::post('/buku', [BukuController::class, 'store']);
        Route::get('/buku/{id}/edit', [BukuController::class, 'edit']);
        Route::put('/buku/{buku}', [BukuController::class, 'update']);
        Route::delete('/buku/{buku}', [BukuController::class, 'destroy']);
        Route::get('/peminjaman', [PeminjamanController::class, 'peminjaman']);
        Route::post('/peminjaman/inputkodepinjam', [PeminjamanController::class, 'inputKodePinjam']);
        Route::post('/peminjaman/inputkodepengembalian', [PeminjamanController::class, 'inputKodePengembalian']);
        Route::post('/generate_laporan', [PeminjamanController::class, 'generateLaporan']);
        Route::get('/denda', [DendaController::class, 'index']);
        Route::put('/denda/{denda}', [DendaController::class, 'bayar']);
        Route::middleware('IsAdmin')->group(function() {
            Route::get('/user', [RegisteredUserController::class, 'listUser']);
            Route::get('/user/create', [RegisteredUserController::class, 'addNewUser']);
            Route::post('/user', [RegisteredUserController::class, 'addNewUserStore']);
        });
    });
});

// useless routes
// Just to demo sidebar dropdown links active states.
// Route::get('/buttons/text', function () {
//     return view('buttons-showcase.text');
// })->middleware(['auth'])->name('buttons.text');

// Route::get('/buttons/icon', function () {
//     return view('buttons-showcase.icon');
// })->middleware(['auth'])->name('buttons.icon');

// Route::get('/buttons/text-icon', function () {
//     return view('buttons-showcase.text-icon');
// })->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';
