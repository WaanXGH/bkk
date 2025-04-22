<?php

use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LokerController;
use App\Http\Controllers\HomeController;
use App\http\Controllers\AdminController;
use App\http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\PenggunaAdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|

\fungsi dari middleware
\memfilter setiap request yang masuk kedalam aplikasi kita
\bisa sebagai security





*/

// Halaman Utama
Route::get('/', [HomeController::class, 'index'])->name('home');

// Login & Register
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login-proses', [LoginController::class, 'login_proses'])->name('login-proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [LoginController::class, 'register'])->name('register');
Route::post('/register-proses', [LoginController::class, 'register_proses'])->name('register-proses');

// User Dashboard (Hanya untuk user yang sudah login dan memiliki peran 'user')
Route::get('/user-dashboard', [UserController::class, 'index'])->middleware(['auth', 'user']);


// Route::middleware(['auth'])->group(function () {}); {
//     Route::get('/lamaran/{id}', [JobController::class, 'showLoker'])->name('lowongan.show');
//     Route::post('/lamaran/{id}/apply', [JobController::class, 'apply_loker'])->name('lowongan.apply');
// }

// Rute lamaran, hanya bisa diakses user login
Route::middleware(['auth'])->group(function () {
    Route::get('/lamaran/{id}', [JobController::class, 'showLoker'])->name('lowongan.show');
    Route::post('/lamaran/{id}/apply', [JobController::class, 'apply_loker'])->name('lowongan.apply');
    Route::get('/lamaran/{id}/edit', [JobController::class, 'edit_lamaran'])->name('lamaran.edit');
    Route::put('/lamaran/{id}/update', [JobController::class, 'update_lamaran'])->name('lamaran.update');
});


// Rute Admin (Hanya untuk admin)
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    //ntar tambah halaman di sini ya misalnya ada halaman pengguna berarti tinggal ditambah route gatenya
    // Route::get('/admin/pengguna', [PenggunaAdminController::class, 'index'])->name('admin.pengguna');
    Route::get('/admin/pengguna', [AdminController::class, 'pengguna'])->name('admin.pengguna');
    Route::put('/admin/users/{id}', [AdminController::class, 'pengguna_edit'])->name('user.update');
    Route::delete('/admin/pengguna/{id}', [AdminController::class, 'destroy'])->name('user.destroy');


    Route::get('/admin/tambah-loker', [AdminController::class, 'Loker'])->name('admin.loker');
    // Route::post('/add-loker', [AdminController::class, 'new_loker'])->name('new-loker');
    Route::post('/test-loker', [AdminController::class, 'Newton'])->name('new-lokers');
    Route::delete('/loker/{id}', [AdminController::class, 'hapus_loker'])->name('loker.destroy');
    Route::put('/loker/edit/{id}', [AdminController::class, 'edit_loker'])->name('loker.update');


    Route::get('/admin/relasi', [AdminController::class, 'relasi'])->name('relasi.dashboard');
    Route::post('/tambah-relasi', [AdminController::class, 'tambah_relasi'])->name('tambah-relasi');
    Route::put('/relasi/{id}', [AdminController::class, 'relasi_edit'])->name('relasi.update');
    Route::delete('/relasi/{id}', [AdminController::class, 'relasi_destroy'])->name('relasi.destroy');

    Route::get('/loker/{id}/pelamar', [AdminController::class, 'lihatPelamar'])->name('loker.pelamar');
    Route::get('/admin/loker/{id}/pelamar', [AdminController::class, 'lihatPelamar'])->name('admin.lihat.pelamar');
    Route::put('/admin/pelamar/{id}/status', [AdminController::class, 'updateStatusPelamar'])->name('admin.pelamar.updateStatus');
    Route::put('/pelamar/{id}/konfirmasi', [AdminController::class, 'konfirmasiPelamar'])->name('pelamar.konfirmasi');
    Route::put('/pelamar/{id}/tolak', [AdminController::class, 'tolakPelamar'])->name('pelamar.tolak');
    Route::get('/admin/test-email', [AdminController::class, 'testEmail'])->name('test-email');
});

// Rute dengan prefix 'admin'
Route::group(['prefix' => 'admin', 'middleware' => ['auth'], 'as' => 'admin.'], function () {
    Route::get('/user', [HomeController::class, 'index'])->name('user.index');
    Route::get('/create', [HomeController::class, 'index'])->name('create');
});
