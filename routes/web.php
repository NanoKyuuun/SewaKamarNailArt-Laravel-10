<?php

use App\Http\Controllers\DashboardUsersController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ProfileController;
use App\Models\Kamar;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $kamar = Kamar::all();
    return view('home',[
        'kamar' => $kamar
    ]);
});

Route::get('/dashboard', [PemesananController::class,'create'])->name('dashboard');
Route::post('/dashboard/pemesanan', [PemesananController::class, 'store']);
Route::resource('/dashboard/pemesanan', PemesananController::class)->names('pesanan');

Route::resource('/dashboard/users', DashboardUsersController::class)->middleware(['auth', 'verified', 'role:admin'])->names('users');
Route::resource('/dashboard/kamar', KamarController::class)->middleware(['auth', 'verified', 'role:admin'])->names('kamar');

Route::get('/dashboard/pembayaran/{id}',[PembayaranController::class,'create']);
Route::post('/dashboard/pembayaran/{id}',[PembayaranController::class,'store']);
Route::get('/dashboard/pembayaran/{id}/pdf',[PembayaranController::class,'pdf']);
Route::resource('/dashboard/pembayaran', PembayaranController::class)->except(['store', 'create'])->names('pembayaran');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
