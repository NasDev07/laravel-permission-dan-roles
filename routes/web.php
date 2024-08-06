<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use GuzzleHttp\Middleware;
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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    Route::resource('konfigurasi/roles', RoleController::class);
});
// Route::controller(RoleController::class)->group(function () {
//     Route::get('/roles', 'index')->Middleware('can:read roles');
//     Route::get('/roles/create', 'create');
//     Route::post('/roles', 'store')->name('roles.store');
//     Route::get('/roles/{role}', 'show')->name('roles.show');
//     Route::get('/roles/{role}/edit', 'edit')->name('roles.edit');
//     Route::put('/roles/{role}', 'update')->name('roles.update');
//     Route::delete('/roles/{role}', 'destroy')->name('roles.destroy');
// });
