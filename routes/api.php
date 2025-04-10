<?php

use App\Http\Controllers\BangChucDanhController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\PhongBanController;
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
// nhan viên
Route::post("/dang-ky-nhan-vien", [NhanVienController::class, "dangKyNhanVien"]);
Route::post("/dang-nhap", [NhanVienController::class, "dangNhap"]);
Route::post('/kiem-tra-chia-khoa', [NhanVienController::class, 'kiemTraChiaKhoa']);

Route::get('/dang-xuat', [NhanVienController::class, 'dangXuat']);


// bang chuc danh
Route::get("/get-bang-chuc-danh", [BangChucDanhController::class, 'getBangChucDanh']);
Route::post("/create-bang-chuc-danh", [BangChucDanhController::class, 'createBangChucDanh']);
Route::put("/update-bang-chuc-danh", [BangChucDanhController::class, 'updateBangChucDanh']);
Route::delete("/delete-bang-chuc-danh/{id}", [BangChucDanhController::class, 'deleteBangChucDanh']);
Route::get("/get-bang-chuc-danh-chi-tiet/{id}", [BangChucDanhController::class, 'getBangChucDanhChiTiet']);

// phong ban
Route::get("/get-phong-ban", [PhongBanController::class, 'getPhongBan']);
Route::post("/create-phong-ban", [PhongBanController::class, 'createPhongBan']);
Route::put("/update-phong-ban", [PhongBanController::class, 'updatePhongBan']);
Route::delete("/delete-phong-ban/{id}", [PhongBanController::class, 'deletePhongBan']);
