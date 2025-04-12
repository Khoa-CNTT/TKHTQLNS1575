<?php

namespace App\Http\Controllers;

use App\Exports\ExcelLoaiHopDongExport;
use App\Http\Requests\LoaiHopDongChangeStatusRequest;
use App\Http\Requests\LoaiHopDongCreateRequest;
use App\Http\Requests\LoaiHopDongDeleteRequest;
use App\Http\Requests\LoaiHopDongUpdateRequest;
use App\Models\LoaiHopDong;
use App\Models\PhanQuyen;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class LoaiHopDongController extends Controller
{

}
