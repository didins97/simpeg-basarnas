<?php

use App\Http\Controllers\ProfileController;
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
    return view('home.index');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // DASHBOARD
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // PEGAWAI
    Route::get('/pegawai', [App\Http\Controllers\PegawaiController::class, 'index'])->name('admin.pegawai.index');
    Route::post('/pegawai', [App\Http\Controllers\PegawaiController::class, 'store'])->name('admin.pegawai.store');
    Route::post('/pegawai/{id}/upload', [App\Http\Controllers\PegawaiController::class, 'uploadDocPendidikan'])->name('admin.pegawai.upload');
    Route::get('/pegawai/{id}/edit', [App\Http\Controllers\PegawaiController::class, 'edit'])->name('admin.pegawai.edit');
    Route::put('/pegawai/{id}', [App\Http\Controllers\PegawaiController::class, 'update'])->name('admin.pegawai.update');
    Route::get('pegawai/{id}/show', [App\Http\Controllers\PegawaiController::class, 'show'])->name('admin.pegawai.show');
    Route::delete('/pegawai/{id}', [App\Http\Controllers\PegawaiController::class, 'destroy'])->name('admin.pegawai.destroy');
    Route::delete('/pegawai/{id}/delete-file', [App\Http\Controllers\PegawaiController::class, 'deleteFile'])->name('admin.pegawai.delete-file');

    // PROMOSI
    Route::get('/promosi', [App\Http\Controllers\NaikJabatanController::class, 'index'])->name('admin.promosi.index');
    Route::get('/promosi/{id}/edit', [App\Http\Controllers\NaikJabatanController::class, 'edit'])->name('admin.promosi.edit');
    Route::get('/promosi/{id}/show', [App\Http\Controllers\NaikJabatanController::class, 'showFile'])->name('admin.promosi.show.file');
    Route::post('/promosi', [App\Http\Controllers\NaikJabatanController::class, 'store'])->name('admin.promosi.store');
    Route::put('/promosi/{id}', [App\Http\Controllers\NaikJabatanController::class, 'update'])->name('admin.promosi.update');
    Route::delete('/promosi/{id}', [App\Http\Controllers\NaikJabatanController::class, 'destroy'])->name('admin.promosi.destroy');

    // MUTASI
    Route::get('/mutasi', [App\Http\Controllers\MutasiController::class, 'index'])->name('admin.mutasi.index');
    Route::get('/mutasi/{id}/edit', [App\Http\Controllers\MutasiController::class, 'edit'])->name('admin.mutasi.edit');
    Route::get('/mutasi/{id}/show', [App\Http\Controllers\MutasiController::class, 'showFile'])->name('admin.mutasi.show.file');
    Route::post('/mutasi', [App\Http\Controllers\MutasiController::class, 'store'])->name('admin.mutasi.store');
    Route::put('/mutasi/{id}', [App\Http\Controllers\MutasiController::class, 'update'])->name('admin.mutasi.update');
    Route::delete('/mutasi/{id}', [App\Http\Controllers\MutasiController::class, 'destroy'])->name('admin.mutasi.destroy');

    // USER
    Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('admin.user.index');
    Route::get('/users/{id}/edit', [App\Http\Controllers\UserController::class, 'edit'])->name('admin.user.edit');
    Route::post('/users', [App\Http\Controllers\UserController::class, 'store'])->name('admin.user.store');
    Route::put('/users/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('admin.user.update');
    Route::delete('/users/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('admin.user.destroy');

    // Route::get('/analysis-gmm', [App\Http\Controllers\AnalysisController::class, 'index'])->name('admin.analysis.index');
    Route::get('/analysis-gmm', [App\Http\Controllers\AnalysisController::class, 'createAnalysis'])->name('admin.analysis.create');
    Route::post('/analysis-gmm', [App\Http\Controllers\AnalysisController::class, 'resultAnalysis'])->name('admin.analysis.store');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/gmm', [App\Http\Controllers\GMMController::class, 'index'])->name('admin.gmm.index');
});

require __DIR__.'/auth.php';
