<?php

namespace App\Http\Controllers;

use App\Exports\ExcelQuyDinhChoDiemExport;
use App\Http\Requests\QDCDChangeStatusRequest;
use App\Http\Requests\QDCDCreateRequest;
use App\Http\Requests\QDCDDeleteRequest;
use App\Http\Requests\QDCDUpdateRequest;
use App\Models\PhanQuyen;
use App\Models\QuyDinhChoDiem;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class QuyDinhChoDiemController extends Controller
{

}
