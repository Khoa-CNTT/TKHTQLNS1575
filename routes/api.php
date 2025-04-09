<?php

use App\Http\Controllers\NhanVienController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/dang-ky-nhan-vien', [NhanVienController::class, "dangKyNhanVien"]);
Route::post('/dang-nhap', [NhanVienController::class, "dangNhap"]);
Route::post('/kiem-tra-chia-khoa', [NhanVienController::class, 'kiemTraChiaKhoa']);
Route::get('/dang-xuat', [NhanVienController::class, 'dangXuat']);
Route::get('/khach-hang/thong-tin/{id}', action: [NhanVienController::class, 'thongTin']);
