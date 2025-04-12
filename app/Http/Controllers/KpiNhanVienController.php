<?php

namespace App\Http\Controllers;

use App\Exports\ExcelKPINhanVienExport;
use App\Http\Requests\CreateKPINhanVienRequest;
use App\Http\Requests\KPINhanVienChamDiemRequest;
use App\Http\Requests\KPINhanVienCreateRequest;
use App\Http\Requests\KPINhanVienDeleteRequest;
use App\Http\Requests\KPINhanVienUpdateRequest;
use App\Http\Requests\UpdateKPINhanVienRequest;
use App\Models\KpiNhanVien;
use App\Models\PhanQuyen;
use App\Models\ThongBao;
use App\Models\TieuChiKPI;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class KpiNhanVienController extends Controller
{

}
