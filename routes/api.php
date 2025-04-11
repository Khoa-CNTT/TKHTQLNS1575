<?php

use App\Http\Controllers\BaoCaoThongKeController;
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
Route::post('/kiem-tra-chia-khoa',  [NhanVienController::class, 'kiemTraChiaKhoa']);
Route::get('/khach-hang/thong-tin', [NhanVienController::class, 'thongTin']);

Route::post('/khach-hang/update-thong-tin', [NhanVienController::class, 'updateThongTin']);
Route::post('/khach-hang/doi-mat-khau', [NhanVienController::class, 'doiMatKhauKhachHang']);
Route::post('/nhan-vien/them-bao-cao', [BaoCaoThongKeController::class, 'createBaoCao']);
Route::get('/nhan-vien/data-bao-cao-ca-nhan', [BaoCaoThongKeController::class, 'dataBaoCaoThongKeCaNhan']);


Route::get('/dang-xuat', [NhanVienController::class, 'dangXuat']);
// Route::get('/khach-hang/thong-tin/{id}', action: [NhanVienController::class, 'thongTin']);
