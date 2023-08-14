<?php

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
// login logout
Route::match(['POST', 'GET'], '/login', [\App\Http\Controllers\login\LoginController::class, 'login'])->name('login');
Route::get('GET',[\App\Http\Controllers\login\LoginController::class,'logout'])->name('logout');
// Amdin
Route::middleware('auth')->group(function (){
    Route::prefix('category')->group(function () {
        Route::get('/list', [\App\Http\Controllers\Admin\LoaiAdminController::class, 'showLoai'])->name('danhsach');
        Route::match(['POST', 'GET'],
            '/add', [\App\Http\Controllers\Admin\LoaiAdminController::class, 'addLoai'])->name('addloai');
        Route::match(['POST', 'GET'],
            '/edit{id}', [\App\Http\Controllers\Admin\LoaiAdminController::class, 'editLoai'])->name('editloai');
        Route::get('deleteLoai/{id}', [\App\Http\Controllers\Admin\LoaiAdminController::class, 'deleteLoai'])->name('deleteLoai');
        Route::get('sreach', [\App\Http\Controllers\Admin\LoaiAdminController::class, 'sreachLoai'])->name('sreachloai');
    });
// admin sản phẩm
    Route::prefix('product')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\SanPhamAdminController::class, 'showProduct'])->name('listsp');
        Route::match(['POST', 'GET'], 'add', [\App\Http\Controllers\Admin\SanPhamAdminController::class, 'addSanPham'])->name('addsanpham');
        Route::match(['POST', 'GET'], 'edit/{id}', [\App\Http\Controllers\Admin\SanPhamAdminController::class, 'editSanPham'])->name('editsanpham');
        Route::get('/del/{id}', [\App\Http\Controllers\Admin\SanPhamAdminController::class, 'delSanPham'])->name('delsanpham');
    });
    Route::prefix('banner')->group(function () {
        Route::get('/list', [\App\Http\Controllers\Admin\SettingController::class, 'showBanner'])->name('list');
        Route::match(['POST', 'GET'], '/add', [\App\Http\Controllers\Admin\SettingController::class, 'addBanner'])->name('addbanner');
        Route::match(['POST', 'GET'], '/edit/{id}', [\App\Http\Controllers\Admin\SettingController::class, 'editBanner'])->name('editbanner');
    });
});




// client

Route::get('/',
    [\App\Http\Controllers\client\HomeController::class, 'showBanner'])
    ->name('/');
Route::get('/sanpham/{id}', [\App\Http\Controllers\client\HomeController::class, 'showDM'])->name('showdm');
Route::get('/detail/{id}', [\App\Http\Controllers\SanPhamCTController::class, 'showDetail'])->name('showdetail');
// tìm kiếm
Route::get('sreach',[\App\Http\Controllers\client\HomeController::class,'sreachSP'])->name('sreach');
Route::post('giohang',[\App\Http\Controllers\client\GioHangController::class,'addGioHang'])->name('giohang');
Route::get('showgiohang',[\App\Http\Controllers\client\GioHangController::class,'showGioHang'])->name('showgiohang');