<?php

use App\Http\Controllers\ImageController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ImageController::class, 'album']);
Route::get('album/{id}', [ImageController::class, 'show'])->name('album.show');

Auth::routes();

Route::prefix('album')->middleware(['auth'])->group(function () {
    Route::get('/', [ImageController::class, 'index'])->name('album.index');
    Route::post('/', [ImageController::class, 'store'])->name('album.store');
    Route::post('/image', [ImageController::class, 'addmore'])->name('album.addmore');
    Route::post('/image/add', [ImageController::class, 'addAlbunImage'])->name('add.album.image');
    Route::delete('/{id}', [ImageController::class, 'destory'])->name('album.destory');
});
