<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KPINhanVienDeleteRequest extends FormRequest
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
            'id' => 'required|exists:kpi_nhan_viens,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'KPI nhân viên không được để trống!',
            'id.exists'   => 'KPI nhân viên không tồn tại!',
        ];
    }
}
