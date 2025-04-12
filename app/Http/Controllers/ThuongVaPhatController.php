<?php

namespace App\Http\Controllers;

use App\Exports\ExcelThuongVaPhatExport;
use App\Http\Requests\ThuongVaPhatCreateRequest;
use App\Http\Requests\ThuongVaPhatDeleteRequest;
use App\Http\Requests\ThuongVaPhatUpdateRequest;
use App\Models\PhanQuyen;
use App\Models\QuyDinhChoDiem;
use App\Models\ThongBao;
use App\Models\ThuongVaPhat;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class ThuongVaPhatController extends Controller
{

}
