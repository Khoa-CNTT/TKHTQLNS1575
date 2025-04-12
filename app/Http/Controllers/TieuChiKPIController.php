<?php

namespace App\Http\Controllers;

use App\Exports\ExcelTieuChiKPIExport;
use App\Http\Requests\TieuChiKpiChangeStatusRequest;
use App\Http\Requests\TieuChiKpiCreateRequest;
use App\Http\Requests\TieuChiKpiDeleteRequest;
use App\Http\Requests\TieuChiKpiUpdateRequest;
use App\Models\PhanQuyen;
use App\Models\ThongBao;
use App\Models\TieuChiKPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class TieuChiKPIController extends Controller
{

}
