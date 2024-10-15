<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminProvinsiController;
use App\Http\Controllers\AdminPusatController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\AnggaranDtController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DekonController;
use App\Http\Controllers\EvaluasiController;
use App\Http\Controllers\IndoregionController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporanEvaluasiController;
use App\Http\Controllers\LaporanMonitoringController;
use App\Http\Controllers\LaporanTPController;
use App\Http\Controllers\TpController;
use App\Http\Controllers\UphController;

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

// Route::get('/about', function () {
//     return view('about');
// });
// Route::get('/', [HomeController::class, "index"]);

// ================ AUTH LOGIN - REGISTER - LOGOUT =====================
Route::get('/', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::delete('/logout', [LoginController::class, 'logout']);

//HOME
Route::get('/dashboard', [DashboardController::class, "index"])->middleware('auth');

//USERS
Route::resource('dashboard/users', AdminPusatController::class)->middleware('auth');
Route::resource('dashboard/admin', AdminProvinsiController::class)->middleware('auth');

//UPH
Route::resource('/dashboard/uph', UphController::class)->middleware('auth');
Route::get('/dashboard/uph/{id}/edit', [UphController::class, 'edit'])->middleware('auth');
Route::put('/dashboard/uph/update/{id}', [UphController::class, 'update'])->middleware('auth');

Route::post('getkabupaten',[UphController::class,'getkabupaten'])->name('getkabupaten');
Route::post('getkecamatan',[UphController::class,'getkecamatan'])->name('getkecamatan');
Route::post('getdesa',[UphController::class,'getdesa'])->name('getdesa');

//MONITORING TP
Route::resource('/dashboard/tp', TpController::class)->middleware('auth');
Route::get('/dashboard/tp/{id}/create', [TpController::class, 'create'])->middleware('auth');
Route::put('/dashboard/tp/store/{id}', [TpController::class, 'store'])->middleware('auth');
Route::get('/dashboard/tp/{id}/edit', [TpController::class, 'edit'])->middleware('auth');
Route::put('/dashboard/tp/update/{id}', [TpController::class, 'update'])->middleware('auth');

//MONITORING DEKON
Route::resource('/dashboard/dekon', DekonController::class)->middleware('auth');
Route::get('/dashboard/dekon/{id}/create', [DekonController::class, 'create'])->middleware('auth');
Route::put('/dashboard/dekon/store/{id}', [DekonController::class, 'store'])->middleware('auth');
Route::get('/dashboard/dekon/{id}/edit', [DekonController::class, 'edit'])->middleware('auth');
Route::put('/dashboard/dekon/update/{id}', [DekonController::class, 'update'])->middleware('auth');

//MONITORING ANGGARAN
Route::resource('/dashboard/anggaran', AnggaranController::class)->middleware('auth');
Route::get('/dashboard/anggaran/{id}/create', [AnggaranController::class, 'create'])->middleware('auth');
Route::put('/dashboard/anggaran/store/{id}', [AnggaranController::class, 'store'])->middleware('auth');
Route::get('/dashboard/anggaran/{id}/show', [AnggaranController::class, 'show'])->middleware('auth');
Route::get('/dashboard/anggaran/{id}/edit', [AnggaranController::class, 'edit'])->middleware('auth');
Route::put('/dashboard/anggaran/update/{id}', [AnggaranController::class, 'update'])->middleware('auth');
Route::get('/dashboard/anggaran/destroy/{id}', [AnggaranController::class, 'destroy'])->middleware('auth');

$router->get('/destroy/{id}', 'Akun\AktifitasController@destroy');



//EVALUASI
Route::resource('/dashboard/evaluasi', EvaluasiController::class)->middleware('auth');
Route::get('/dashboard/evaluasi/{id}/create', [EvaluasiController::class, 'create'])->middleware('auth');
Route::put('/dashboard/evaluasi/store/{id}', [EvaluasiController::class, 'store'])->middleware('auth');
Route::get('/dashboard/evaluasi/{id}/edit', [EvaluasiController::class, 'edit'])->middleware('auth');
Route::put('/dashboard/evaluasi/update/{id}', [EvaluasiController::class, 'update'])->middleware('auth');

//LAPORAN
Route::resource('/dashboard/laporan', LaporanController::class)->middleware('auth');

Route::resource('/dashboard/laporan_monitoring', LaporanMonitoringController::class)->middleware('auth');
Route::get('/dashboard/laporan_anggaran/{id}/show', [LaporanMonitoringController::class, 'show_anggaran'])->middleware('auth');
Route::get('/dashboard/laporan_tp/{id}/show', [LaporanMonitoringController::class, 'show_tp'])->middleware('auth');
Route::get('/dashboard/laporan_dekon/{id}/show', [LaporanMonitoringController::class, 'show_dekon'])->middleware('auth');

Route::resource('/dashboard/laporan_evaluasi', LaporanEvaluasiController::class)->middleware('auth');
Route::get('/dashboard/laporan_evaluasi/{id}/show', [LaporanEvaluasiController::class, 'show'])->middleware('auth');

// ========================== INDOREGION API =====================================
Route::resource('/dashboard/form', IndoregionController::class);
Route::post('getkabupaten',[IndoregionController::class,'getkabupaten'])->name('getkabupaten');
Route::post('getkecamatan',[IndoregionController::class,'getkecamatan'])->name('getkecamatan');
Route::post('getdesa',[IndoregionController::class,'getdesa'])->name('getdesa');