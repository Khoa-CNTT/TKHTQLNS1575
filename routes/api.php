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
<<<<<<< HEAD
Route::post('/kiem-tra-chia-khoa',  [NhanVienController::class, 'kiemTraChiaKhoa']);

Route::get('/khach-hang/thong-tin', [NhanVienController::class, 'thongTin']);
Route::post('/khach-hang/update-thong-tin', [NhanVienController::class, 'updateThongTin']);
Route::post('/khach-hang/update-mat-khau', [NhanVienController::class, 'updateMatKhau']);


=======
Route::post('/kiem-tra-chia-khoa', [NhanVienController::class, 'kiemTraChiaKhoa']);
Route::get('/dang-xuat', [NhanVienController::class, 'dangXuat']);
Route::get('/khach-hang/thong-tin/{id}', action: [NhanVienController::class, 'thongTin']);
>>>>>>> 2285507a1007885bb5f2349ca870ba64a493f910
