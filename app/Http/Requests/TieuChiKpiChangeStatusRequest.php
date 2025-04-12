<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TieuChiKpiChangeStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id' => 'required|exists:tieu_chi_kpis,id',
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'Tiêu chí KPI không được để trống.',
            'id.exists'   => 'Tiêu chí KPI không tồn tại trong hệ thống.',
        ];
    }

}
