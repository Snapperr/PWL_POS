<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PenjualanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\AuthController;

Route::get('/', [WelcomeController::class, 'index'])->middleware('auth');

Route::pattern('id', '[0-9]+');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('postlogin', [AuthController::class, 'postlogin']);
//Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('account/create', [UserController::class, 'showRegistrationForm'])->name('register.form');
Route::post('account/store', [UserController::class, 'register'])->name('register.submit');

Route::middleware('auth')->group(function () {
Route::get('/', [WelcomeController::class, 'index']);

Route::middleware(['authorize:ADM'])->group(function () {
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index']);                          // Menampilkan halaman awal user
        Route::post('/list', [UserController::class, 'list']);                      // Menampilkan data user dalam bentuk json untuk datatables
        Route::get('/create', [UserController::class, 'create']);                   // Menampilkan halaman form tambah user
        Route::post('/', [UserController::class, 'store']);                         // Menyimpan data user baru
        Route::get('/create_ajax', [UserController::class, 'create_ajax']);         // Menampilkan halaman form tambah user Ajax
        Route::post('/ajax', [UserController::class, 'store_ajax']);                // Menyimpan data user baru Ajax
        Route::get('/{id}', [UserController::class, 'show']);                       // Menampilkan detail user
        Route::get('/{id}/edit', [UserController::class, 'edit']);                  // Menampilkan halaman form edit user
        Route::put('/{id}', [UserController::class, 'update']);                     // Menyimpan perubahan data user
        Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);        // Menampilkan halaman form edit user Ajax
        Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']);    // Menyimpan perubahan data user Ajax.
        Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);   // Untuk tmpilkan form confirm delete user Ajax
        Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // Untuk hapus data user Ajax
        Route::delete('/{id}', [UserController::class, 'destroy']);                 // Menghapus data user
    });

    Route::group(['prefix' => 'level'], function() {
        Route::get('/', [LevelController::class, 'index']);
        Route::post('/list', [LevelController::class, 'list']);
        Route::get('/create', [LevelController::class, 'create']);
        Route::post('/', [LevelController::class, 'store']);
        Route::get('/create_ajax', [LevelController::class, 'create_ajax']);
        Route::post('/ajax', [LevelController::class, 'store_ajax']);
        Route::get('/{id}', [LevelController::class, 'show']);
        Route::get('/{id}/edit', [LevelController::class, 'edit']);
        Route::put('/{id}', [LevelController::class, 'update']);
        Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']);
        Route::delete('/{id}', [LevelController::class, 'destroy']);
    });
});

Route::middleware(['authorize:ADM,MNG'])->group(function () {
    Route::group(['prefix' => 'kategori'], function () {
        Route::get('/', [KategoriController::class, 'index']);
        Route::post('/list', [KategoriController::class, 'list']);
        Route::get('/create', [KategoriController::class, 'create']);
        Route::post('/', [KategoriController::class, 'store']);
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']);
        Route::post('/ajax', [KategoriController::class, 'store_ajax']);
        Route::get('/{id}', [KategoriController::class, 'show']);
        Route::get('/{id}/edit', [KategoriController::class, 'edit']);
        Route::put('/{id}', [KategoriController::class, 'update']);
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']);
        Route::delete('/{id}', [KategoriController::class, 'destroy']);
    });

    Route::group(['prefix' => 'barang'], function () {
        Route::get('/', [BarangController::class, 'index']);
        Route::post('/list', [BarangController::class, 'list']);
        Route::get('/create', [BarangController::class, 'create']);
        Route::post('/', [BarangController::class, 'store']);
        Route::get('/create_ajax', [BarangController::class, 'create_ajax']);
        Route::post('/ajax', [BarangController::class, 'store_ajax']);
        Route::get('/{id}', [BarangController::class, 'show']);
        Route::get('/{id}/edit', [BarangController::class, 'edit']);
        Route::put('/{id}', [BarangController::class, 'update']);
        Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']);
        Route::delete('/{id}', [BarangController::class, 'destroy']);
        Route::get('/import', [BarangController::class, 'import']);
        Route::post('/import_ajax', [BarangController::class, 'import_ajax']);
        Route::get('/export_excel', [BarangController::class, 'export_excel']); 
        Route::get('/export_pdf', [BarangController::class, 'export_pdf']); 
    });

    Route::group(['prefix' => 'stok'], function () {
        Route::get('/', [StokController::class, 'index']);
        Route::post('/list', [StokController::class, 'list']);
        Route::get('/create', [StokController::class, 'create']);
        Route::post('/', [StokController::class, 'store']);
        Route::get('/create_ajax', [StokController::class, 'create_ajax']);
        Route::post('/ajax', [StokController::class, 'store_ajax']);
        Route::get('/{id}', [StokController::class, 'show']);
        Route::get('/{id}/edit', [StokController::class, 'edit']);
        Route::put('/{id}', [StokController::class, 'update']);
        Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']);
        Route::put('/{id}', [StokController::class, 'update']);
        Route::delete('/{id}', [StokController::class, 'destroy']);
    });
});

Route::middleware(['authorize:ADM,MNG,STF'])->group(function () {
    Route::group(['prefix' => 'penjualan'], function () {
        Route::get('/', [PenjualanController::class, 'index']);
        Route::post('/list', [PenjualanController::class, 'list']);
        Route::get('/create', [PenjualanController::class, 'create']);
        Route::post('/', [PenjualanController::class, 'store']);
        Route::get('/create_ajax', [PenjualanController::class, 'create_ajax']);
        Route::post('/ajax', [PenjualanController::class, 'store_ajax']);
        Route::get('/{id}', [PenjualanController::class, 'show']);
        Route::get('/{id}/edit', [PenjualanController::class, 'edit']);
        Route::put('/{id}', [PenjualanController::class, 'update']);
        Route::get('/{id}/edit_ajax', [PenjualanController::class, 'edit_ajax']);
        Route::put('/{id}/update_ajax', [PenjualanController::class, 'update_ajax']);
        Route::get('/{id}/delete_ajax', [PenjualanController::class, 'confirm_ajax']);
        Route::delete('/{id}/delete_ajax', [PenjualanController::class, 'delete_ajax']);
        Route::delete('/{id}', [PenjualanController::class, 'destroy']);
    });
});
});

// Route::get('/level', [LevelController::class, 'index']);

// Route::get('/kategori', [KategoriController::class, 'index']);

// Route::get('/user', [UserController::class, 'index']);

// Route::get('/user/tambah', [UserController::class, 'tambah']);

// Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);

// Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);

// Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);

// Route::put('/user/tambah_simpan/{id}', [UserController::class, 'tambah_simpan']);

// Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

// Route::get('/', [WelcomeController::class, 'index']);

