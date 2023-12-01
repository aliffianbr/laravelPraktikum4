<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
// prak 2
use App\Http\Controllers\Controller1;
// prak 3b
use App\Http\Middleware\CekStatus;
use App\Http\Middleware\CheckAge;

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
    return view('welcome');
});

// prak 1
Route::get('/praktek1', function () {
    return view('praktek1', ['jenis_tombol' => "-"]);
});

Route::get('/tombol/{jenis_tombol}', function ($jenis_tombol) {
    return view('praktek1', ['jenis_tombol' => @$jenis_tombol]);
});

// prak 2
Route::get('/tampil1', [Controller1::class, 'tampil1']);
Route::post('/tampilkan', [Controller1::class, 'tampilkan']);
Route::view('/tampil2', 'tampil2');


// prak 3
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/tampil1', [Controller1::class, 'tampil1']);
    Route::get('/tampilkan', [Controller1::class, 'tampilkan']);
});

Route::get('/logout', [Controller1::class, 'logout']);

require __DIR__.'/auth.php';

// prak 3b
// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::middleware([CheckAge::class])->group(function () {
    Route::get('dewasa', function () {
        return 'Selamat !! anda sudah dewasa !!';
    });
});

Route::get('/belumdewasa', function () {
    return "Maaf anda belum dewasa !!";
});

// Cek status
Route::middleware([CekStatus::class])->group(function () {
    Route::get('/status', function () {
        return 'Selamat !! anda masih bujangan !!';
    });
});

Route::get('/tidakboleh', function () {
    return "Maaf anda tidak boleh masuk !!";
});
