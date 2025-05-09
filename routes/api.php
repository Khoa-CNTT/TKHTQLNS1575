<?php

use App\Http\Controllers\ChamCongController;
use App\Http\Controllers\ChiTietHopDongController;
use App\Http\Controllers\ChucVuController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\KpiNhanVienController;
use App\Http\Controllers\LoaiHopDongController;
use App\Http\Controllers\LoaiVangController;
use App\Http\Controllers\NghiPhepController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\PhanQuyenController;
use App\Http\Controllers\PhongBanController;
use App\Http\Controllers\QuyDinhChoDiemController;
use App\Http\Controllers\ThongBaoController;
use App\Http\Controllers\ThongKeController;
use App\Http\Controllers\ThuongVaPhatController;
use App\Http\Controllers\TieuChiKPIController;
use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/admin/dang-xuat', [NhanVienController::class, 'dangXuat']);
Route::get('/admin/dang-xuat-all', [NhanVienController::class, 'dangXuatAll']);

Route::post('/admin/thong-bao/data', [ThongBaoController::class, 'getDataThongBao']);

Route::post('/admin/dang-nhap', [NhanVienController::class, 'login']);
Route::get('/admin/nhan-vien/data', [NhanVienController::class, 'getData']);
Route::get('/admin/nhan-vien/data-open', [NhanVienController::class, 'getDataOpen']);
Route::post('/admin/nhan-vien/tim-kiem', [NhanVienController::class, 'timKiemNhanVien']);
Route::post('/admin/nhan-vien/create', [NhanVienController::class, 'store']);
Route::post('/admin/nhan-vien/change-status', [NhanVienController::class, 'changeStatus']);
Route::post('/admin/nhan-vien/update', [NhanVienController::class, 'updateNhanVien']);
Route::post('/admin/nhan-vien/delete', [NhanVienController::class, 'deleteNhanVien']);
Route::get('/admin/nhan-vien/xuat-excel', [NhanVienController::class, 'xuatExcelNhanVien']);
Route::post('/admin/tinh-luong', [NhanVienController::class, 'tinhLuong']);
Route::post('/admin/tinh-luong-4', [NhanVienController::class, 'tinhLuong4']);
Route::post('/admin/luong/xuat-excel', [NhanVienController::class, 'xuatExcelLuong']);
Route::post('/admin/luong-theo-thang/xuat-excel', [NhanVienController::class, 'xuatExcelLuongTheoThang']);
Route::get('/admin/thong-tin', [NhanVienController::class, 'thongTin']);
Route::post('/admin/update-thong-tin', [NhanVienController::class, 'updateThongTin']);
Route::post('/admin/update-mat-khau', [NhanVienController::class, 'updateMatKhau']);
Route::post('/admin/quen-mat-khau', [NhanVienController::class, 'actionQuenmatKhau']);
Route::post('/admin/lay-lai-mat-khau/{hash_reset}', [NhanVienController::class, 'actionLayLaiMatKhau']);


Route::get('/admin/chuc-vu/data', [ChucVuController::class, 'getData']);
Route::get('/admin/chuc-vu/data-open', [ChucVuController::class, 'getDataOpen']);
Route::post('/admin/chuc-vu/create', [ChucVuController::class, 'store']);
Route::post('/admin/chuc-vu/change-status', [ChucVuController::class, 'changeStatus']);
Route::post('/admin/chuc-vu/update', [ChucVuController::class, 'updateChucVu']);
Route::post('/admin/chuc-vu/delete', [ChucVuController::class, 'deleteChucVu']);
Route::get('/admin/chuc-vu/xuat-excel', [ChucVuController::class, 'xuatExcelChucVu']);

Route::get('/admin/phong-ban/data', [PhongBanController::class, 'getData']);
Route::get('/admin/phong-ban/data-open', [PhongBanController::class, 'getDataOpen']);
Route::post('/admin/phong-ban/create', [PhongBanController::class, 'store']);
Route::post('/admin/phong-ban/change-status', [PhongBanController::class, 'changeStatus']);
Route::post('/admin/phong-ban/update', [PhongBanController::class, 'updatePhongBan']);
Route::post('/admin/phong-ban/delete', [PhongBanController::class, 'deletePhongBan']);
Route::get('/admin/phong-ban/xuat-excel', [PhongBanController::class, 'xuatExcelPhongBan']);

Route::get('/admin/tieu-chi-kpi/data', [TieuChiKPIController::class, 'getData']);
Route::get('/admin/tieu-chi-kpi/data-open', [TieuChiKPIController::class, 'getDataOpen']);
Route::post('/admin/tieu-chi-kpi/create', [TieuChiKPIController::class, 'store']);
Route::post('/admin/tieu-chi-kpi/change-status', [TieuChiKPIController::class, 'changeStatus']);
Route::post('/admin/tieu-chi-kpi/update', [TieuChiKPIController::class, 'updateTieuChiKPI']);
Route::post('/admin/tieu-chi-kpi/delete', [TieuChiKPIController::class, 'deleteTieuChiKPI']);
Route::get('/admin/tieu-chi-kpi/xuat-excel', [TieuChiKPIController::class, 'xuatExcelTieuChiPKI']);

Route::get('/admin/quy-dinh-cho-diem/data', [QuyDinhChoDiemController::class, 'getData']);
Route::get('/admin/quy-dinh-cho-diem/data-open', [QuyDinhChoDiemController::class, 'getDataOpen']);
Route::post('/admin/quy-dinh-cho-diem/create', [QuyDinhChoDiemController::class, 'store']);
Route::post('/admin/quy-dinh-cho-diem/change-status', [QuyDinhChoDiemController::class, 'changeStatus']);
Route::post('/admin/quy-dinh-cho-diem/update', [QuyDinhChoDiemController::class, 'updateQuyDinhChoDiem']);
Route::post('/admin/quy-dinh-cho-diem/delete', [QuyDinhChoDiemController::class, 'deleteQuyDinhChoDiem']);
Route::get('/admin/quy-dinh-cho-diem/xuat-excel', [QuyDinhChoDiemController::class, 'xuatExcelQuyDinhChoDiem']);

Route::get('/admin/loai-hop-dong/data', [LoaiHopDongController::class, 'getData']);
Route::get('/admin/loai-hop-dong/data-open', [LoaiHopDongController::class, 'getDataOpen']);
Route::post('/admin/loai-hop-dong/create', [LoaiHopDongController::class, 'store']);
Route::post('/admin/loai-hop-dong/change-status', [LoaiHopDongController::class, 'changeStatus']);
Route::post('/admin/loai-hop-dong/update', [LoaiHopDongController::class, 'updateLoaiHopDong']);
Route::post('/admin/loai-hop-dong/delete', [LoaiHopDongController::class, 'deleteLoaiHopDong']);
Route::get('/admin/loai-hop-dong/xuat-excel', [LoaiHopDongController::class, 'xuatExcelLoaiHopDong']);


Route::get('/admin/chi-tiet-hop-dong/data', [ChiTietHopDongController::class, 'getData']);
Route::post('/admin/chi-tiet-hop-dong/create', [ChiTietHopDongController::class, 'store']);
Route::get('/admin/chi-tiet-hop-dong/xuat-excel', [ChiTietHopDongController::class, 'xuatExcelChiTietHopDong']);

Route::get('/admin/kpi-nhan-vien/data', [KpiNhanVienController::class, 'getData']);
Route::post('/admin/kpi-nhan-vien/create', [KpiNhanVienController::class, 'store']);
Route::post('/admin/kpi-nhan-vien/cham-diem', [KpiNhanVienController::class, 'chamDiem']);
Route::post('/admin/kpi-nhan-vien/update', [KpiNhanVienController::class, 'updateKpiNhanVien']);
Route::post('/admin/kpi-nhan-vien/delete', [KpiNhanVienController::class, 'deleteKpiNhanVien']);
Route::post('/admin/kpi-nhan-vien/tim-kiem', [KpiNhanVienController::class, 'timKiemKpiNhanVien']);
Route::get('/admin/kpi-nhan-vien/xuat-excel', [KpiNhanVienController::class, 'xuatExcelKPINhanVien']);

Route::get('/admin/cham-cong/data', [ChamCongController::class, 'getData']);
Route::post('/admin/cham-cong/create', [ChamCongController::class, 'store']);
Route::post('/admin/cham-cong/update', [ChamCongController::class, 'updateChamCong']);
Route::post('/admin/cham-cong/delete', [ChamCongController::class, 'deleteChamCong']);
Route::get('/admin/cham-cong/xuat-excel', [ChamCongController::class, 'xuatExcelChamCong']);

Route::get('/admin/thuong-va-phat/data', [ThuongVaPhatController::class, 'getData']);
Route::post('/admin/thuong-va-phat/create', [ThuongVaPhatController::class, 'store']);
Route::post('/admin/thuong-va-phat/update', [ThuongVaPhatController::class, 'updateThuongPhat']);
Route::post('/admin/thuong-va-phat/delete', [ThuongVaPhatController::class, 'deleteThuongPhat']);
Route::post('/admin/thuong-va-phat/tim-kiem', [ThuongVaPhatController::class, 'timKiemThuongPhat']);
Route::get('/admin/thuong-va-phat/xuat-excel', [ThuongVaPhatController::class, 'xuatExcelThuongVaPhat']);

Route::post('/admin/cham-cong/thong-ke', [ThongKeController::class, 'thongKeChamCong']);
Route::post('/admin/kpi-nhan-vien/thong-ke', [ThongKeController::class, 'thongKeKPINhanVien']);
Route::post('/admin/diem-phat/thong-ke', [ThongKeController::class, 'thongKeDiemPhat']);
Route::post('/admin/diem-thuong/thong-ke', [ThongKeController::class, 'thongKeDiemThuong']);

Route::post('/admin/chuc-nang/data', [PhanQuyenController::class, 'getListChucNang']);
Route::post('/admin/phan-quyen/create', [PhanQuyenController::class, 'setQuyen']);
Route::post('/admin/phan-quyen/delete', [PhanQuyenController::class, 'delQuyen']);

Route::get('/admin/check-login', [NhanVienController::class, 'checkLogin']);

Route::get("/admin/get-loai-vang", [LoaiVangController::class, "getLoaiVang"]);
Route::post("/admin/them-loai-vang", [LoaiVangController::class, "themLoaiVang"]);
Route::put("/admin/sua-loai-vang", [LoaiVangController::class, "suaLoaiVang"]);
Route::delete('/admin/xoa-loai-vang/{id}', [LoaiVangController::class, 'xoaLoaiVang']);



Route::post("/admin/them-bao-cao-vang", [NghiPhepController::class, "themBaoCaoVang"]);
Route::get("/admin/get-bao-cao-vang", [NghiPhepController::class, "getBaoCaoVang"]);
Route::put("/admin/sua-bao-cao-vang", [NghiPhepController::class, "suaBaoCaoVang"]);
Route::delete('/admin/xoa-bao-cao-vang/{id}', [NghiPhepController::class, 'xoaBaoCaoVang']);
Route::get('/admin/bao-cao-vang/xuat-excel', [NghiPhepController::class, 'xuatExcel']);
Route::post("/admin/trang-thai-chap-nhan", [NghiPhepController::class, "trangThaiChapNhan"]);
Route::post("/admin/trang-thai-tu-choi", [NghiPhepController::class, "trangThaiTuChoi"]);
Route::get('/admin/cham-cong-ntf/{id}', [ChamCongController::class, 'actionChamCongNtf']);

Route::get('/admin/nghi-phep/data', [NghiPhepController::class, 'getData']);
Route::post('/admin/nghi-phep/create', [NghiPhepController::class, 'store']);
Route::post('/admin/nghi-phep/update', [NghiPhepController::class, 'update']);
Route::delete('/admin/nghi-phep/delete/{id}', [NghiPhepController::class, 'delete']);
Route::post('/admin/nghi-phep/change-status', [NghiPhepController::class, 'changeStatus']);

Route::get('/get-ip', [ConfigController::class, 'configIP']);
