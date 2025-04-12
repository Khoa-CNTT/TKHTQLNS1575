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



Route::get('/admin/check-login', [NhanVienController::class, 'checkLogin']);
