<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KPINhanVienCreateRequest extends FormRequest
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
            'id_nhan_vien' => 'required|exists:nhan_viens,id',
            'id_tieu_chi'  => 'required|exists:tieu_chi_kpis,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id_nhan_vien.required' => 'Nhân viên không được để trống!',
            'id_nhan_vien.exists'   => 'Nhân viên không tồn tại!',
            'id_tieu_chi.required'  => 'Tiêu chí không được để trống!',
            'id_tieu_chi.exists'    => 'Tiêu chí không tồn tại!',
        ];
    }
}
