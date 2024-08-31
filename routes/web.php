<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\KeluarController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;

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
    return redirect("/dashboard/home");
})->middleware("auth");
Route::get("/login",[AuthController::class,"index"])->middleware("guest")->name("login");
Route::Post("/login",[AuthController::class,"login"]);
Route::Post("/logout",[AuthController::class,"logout"]);
Route::prefix('dashboard')->group(function () {
    Route::get("/home",[DashboardController::class,"index"])->middleware("auth");
    Route::resource("/kelola",BarangController::class)->middleware("auth");
    Route::get('/kelola/keluar/{barang}',[BarangController::class,'keluar'])->middleware("auth");
    Route::post('/kelola/keluar/{barang}',[BarangController::class,'keluarStore'])->middleware("auth");
    Route::resource("/keluar",KeluarController::class)->middleware("auth");
    Route::post("/keluar/batal/{barang:id}",[KeluarController::class,"batal"])->middleware("auth");
    Route::get('/export', [ExportController::class, 'index'])->name("export.index")->middleware("auth");
    Route::post('/export', [ExportController::class, 'export'])->name("export")->middleware("auth");
    Route::resource("/kategori",KategoriController::class)->middleware("auth");
    route::resource("/addadmin",UserController::class)->middleware("auth");
});
