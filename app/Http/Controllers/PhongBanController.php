<?php

namespace App\Http\Controllers;

use App\Exports\ExcelPhongBanExport;
use App\Http\Requests\CreatePhongBanRequest;
use App\Http\Requests\PhongBanChangeStatusRequest;
use App\Http\Requests\PhongBanDeleteRequest;
use App\Http\Requests\PhongBanUpdateRequest;
use App\Models\PhanQuyen;
use App\Models\PhongBan;
use App\Models\ThongBao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PhongBanController extends Controller
{

}
