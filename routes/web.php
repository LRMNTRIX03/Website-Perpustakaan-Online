<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DaftarAnggotaController;
use App\Http\Controllers\DaftarBukuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\AdminPeminjamanController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('login');
})->name('login');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::get('password/reset', [PasswordResetController::class, 'request'])->name('password.request');
Route::post('password/email', [PasswordResetController::class, 'email'])->name('password.email');
Route::get('password/reset/{token}', [PasswordResetController::class, 'resetForm'])->name('password.reset');
Route::post('password/reset', [PasswordResetController::class, 'reset'])->name('password.update');


Route::middleware('auth')->group(function(){
    Route::get('peringatan', function(){
        return view('peringatan');
    });

    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

    // Group untuk admin
    Route::middleware('UserAkses:admin')->group(function(){
        Route::get('/admin', [DashboardController::class, 'dashboardAdmin'])->name('admin.dashboard');
        Route::get('/admin/peminjaman', [AdminPeminjamanController::class, 'index'])->name('admin.peminjaman.index');
        Route::post('/admin/peminjaman/approve/{id}', [AdminPeminjamanController::class, 'approve'])->name('admin.peminjaman.approve');
        Route::post('/admin/peminjaman/reject/{id}', [AdminPeminjamanController::class, 'reject'])->name('admin.peminjaman.reject');
      
        Route::resource('buku', DaftarBukuController::class);
        Route::put('/buku/{id}', [DaftarBukuController::class, 'update'])->name('buku.update');
        Route::resource('kategori', KategoriController::class);
        Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::resource('anggota', DaftarAnggotaController::class);
        Route::get('/anggota/print/{id}', [DaftarAnggotaController::class, 'print'])->name('anggota.print');
        Route::put('/anggota/{id}', [DaftarAnggotaController::class, 'update'])->name('anggota.update');
        Route::get('/pinjaman', [AdminPeminjamanController::class, 'index'])->name('admin.pinjaman.index');
        Route::post('/pinjaman/approve/{id}', [AdminPeminjamanController::class, 'approve'])->name('admin.pinjaman.approve');
        Route::post('/pinjaman/reject/{id}', [AdminPeminjamanController::class, 'reject'])->name('admin.pinjaman.reject');
        Route::post('/pinjaman/delete/{id}', [AdminPeminjamanController::class, 'destory'])->name('admin.pinjaman.destroy');
        Route::post('/pinjaman/konfirmasi/{id}', [AdminPeminjamanController::class, 'confirmBayar'])->name('admin.pinjaman.konfirmasi');
        Route::post('/pinjaman/tolak/{id}', [AdminPeminjamanController::class, 'rejectBukti'])->name('admin.pinjaman.penolakan');


       

    });

    
    Route::middleware('UserAkses:user')->group(function(){
        Route::get('/dashboard', [DashboardController::class, 'dashboardUser'])->name('user.dashboard');
        Route::get('DaftarBuku', [UserController::class, 'DaftarBuku'])->name('user.daftarBuku');
        Route::get('/DaftarBuku/{id}', [UserController::class, 'Detail'])->name('user.bookDetail');
        Route::get('/profile/gantipassword/{id}', [ProfileController::class, 'editPassword'])->name('profile.editPassword');
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/gantipassword/change/{id}', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
        Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('pinjam.index');
        Route::post('/peminjaman/buktibayar/{peminjaman_id}', [PeminjamanController::class, 'buktiBayar'])->name('pinjam.buktiBayar');
        Route::post('/buku/pinjam/', [PeminjamanController::class, 'pinjam'])->name('buku.pinjam');
        Route::get('/buku/baca/{peminjaman}', [PeminjamanController::class, 'bacaBuku'])->name('buku.baca');
        Route::post('/buku/kembalikan/{peminjaman_id}', [PeminjamanController::class, 'kembalikan'])->name('buku.kembalikan');
    });
});
