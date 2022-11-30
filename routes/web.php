<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('user', UserController::class);
    Route::get('delus/{user}', [UserController::class, 'destroy']);    
    Route::get('akses/{buku}', [BukuController::class, 'akses']);
});
Route::middleware(['auth'])->group(function () {
    Route::resource('kategori', KategoriController::class);
    Route::get('delkat/{kategori}', [KategoriController::class, 'destroy']);
    Route::resource('buku', BukuController::class);
    Route::get('delbk/{buku}', [BukuController::class, 'destroy']);
});
Route::get('/', [BukuController::class, 'home']);
Route::get('detail/{buku}', [BukuController::class, 'show']);

Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
