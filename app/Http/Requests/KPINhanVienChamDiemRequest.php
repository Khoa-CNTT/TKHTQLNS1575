<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KPINhanVienChamDiemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id'             => 'required|exists:kpi_nhan_viens,id',
            'diem_duoc_cham' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required'             => 'KPI nhân viên cần chấm điểm không được để trống!',
            'id.exists'               => 'KPI nhân viên cần chấm điểm không tồn tại!',
            'diem_duoc_cham.required' => 'Điểm được chấm không được để trống!',
            'diem_duoc_cham.numeric'  => 'Điểm phải là số!',
        ];
    }
}
