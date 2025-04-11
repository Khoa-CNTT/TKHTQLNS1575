<?php

use App\Http\Controllers\LoaiVangController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\QuanLyHopDongController;
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

Route::post("/dang-ky-nhan-vien", [NhanVienController::class, "dangKyNhanVien"]);
Route::post("/dang-nhap", [NhanVienController::class, "dangNhap"]);
Route::post('/kiem-tra-chia-khoa', [NhanVienController::class, 'kiemTraChiaKhoa']);

//QuanLyHopDong
Route::get('/get-quan-ly-hop-dong', [QuanLyHopDongController::class, 'getQuanLyHopDong']);
Route::post('/them-quan-ly-hop-dong', [QuanLyHopDongController::class, 'themQuanLyHopDong']);
Route::put('/cap-nhat-quan-ly-hop-dong', [QuanLyHopDongController::class, 'capNhatQuanLyHopDong']);
Route::delete('/xoa-quan-ly-hop-dong/{id}', [QuanLyHopDongController::class, 'xoaQuanLyHopDong']);

