<?php

require __DIR__ . '/auth.php';
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UrunController;
use App\Http\Controllers\VerilerController;


Route::get('/', function () {
    return view('welcome');
});


Route::get('/', [HomeController::class, 'index'])->name('index');



////////////////////////////////////////////////////////////////////////////////////////////
route::prefix('panel')->middleware(['auth'])->group(function () {

    Route::get('/', [HomeController::class, 'panel'])->name('home');

    // ÜRÜNLER
    Route::get('urunler', [UrunController::class, 'select'])->name('urun');
    Route::post('urun/ekle', [UrunController::class, 'ekle'])->name('urun.ekle');
    Route::post('urun/guncelle', [UrunController::class, 'guncelle'])->name('urun.guncelle');
    Route::get('urun/sirala', [UrunController::class, 'sirala'])->name('urun.sirala');
    Route::post('urun/sirala/update', [UrunController::class, 'siralaUpdate'])->name('urun.sirala.update');

    // KATEGORİLER
    Route::get('kategoriler', [KategoriController::class, 'select'])->name('kategori');
    Route::post('kategori/ekle', [KategoriController::class, 'kategoriupdate'])->name('kategori.ekle');
    Route::post('kategori/guncelle', [KategoriController::class, 'guncelle'])->name('kategori.guncelle');

    // VERİLER
    Route::get('veriler', [VerilerController::class, 'select'])->name('baglantilar');
    Route::post('veriler/guncelle', [VerilerController::class, 'guncelle'])->name('baglantilar.guncelle');

    // CACHE TEMİZLE
    Route::get('/cache-clear', function () {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:cache');
        Artisan::call('optimize:clear');
        cache()->flush();
        return '<h1>All Caches Cleared!!!</h1><br><button><a href="/">Back</a></button>';
    });

});
