<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfrastrukturController;
use App\Http\Controllers\KemiskinanController;
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

Route::get('/', [HomeController::class, 'index']);

Route::get('/kemiskinan', [KemiskinanController::class, 'index']);
Route::get('kecamatan', [KemiskinanController::class, 'getKecamatan'])->name('kecamatan');
Route::post('pilihWilayah', [KemiskinanController::class, 'pilihWilayah']);

Route::get('/infra', [InfrastrukturController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);
