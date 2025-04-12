<?php

use App\Http\Controllers\ChamCongController;
use App\Http\Controllers\ChiTietHopDongController;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\KpiNhanVienController;
use App\Http\Controllers\LoaiHopDongController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\PhanQuyenController;
use App\Http\Controllers\PhongBanController;
use App\Http\Controllers\QuyDinhChoDiemController;
use App\Http\Controllers\ThongBaoController;
use App\Http\Controllers\ThongKeController;
use App\Http\Controllers\ThuongVaPhatController;
use App\Http\Controllers\TieuChiKPIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/admin/dang-xuat', [NhanVienController::class, 'dangXuat']);
Route::get('/admin/dang-xuat-all', [NhanVienController::class, 'dangXuatAll']);
Route::post('/admin/dang-nhap', [NhanVienController::class, 'login']);
Route::get('/admin/check-login', [NhanVienController::class, 'checkLogin']);


Route::get('/admin/chuc-vu/xuat-excel', [ChucVuController::class, 'xuatExcelChucVu']);
Route::post('/admin/chuc-vu/create', [ChucVuController::class, 'store']);
Route::post('/admin/chuc-vu/change-status', [ChucVuController::class, 'changeStatus']);
Route::post('/admin/chuc-vu/update', [ChucVuController::class, 'updateChucVu']);
Route::post('/admin/chuc-vu/delete', [ChucVuController::class, 'deleteChucVu']);
Route::get('/admin/chuc-vu/data', [ChucVuController::class, 'getData']);



Route::post('/admin/chuc-nang/data', [PhanQuyenController::class, 'getListChucNang']);
Route::post('/admin/phan-quyen/create', [PhanQuyenController::class, 'setQuyen']);
Route::post('/admin/phan-quyen/delete', [PhanQuyenController::class, 'delQuyen']);
