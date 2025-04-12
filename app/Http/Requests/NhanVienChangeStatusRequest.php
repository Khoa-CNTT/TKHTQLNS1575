<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NhanVienChangeStatusRequest extends FormRequest
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
            'id'                    =>  'required|exists:nhan_viens,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required'                 => 'Vui lòng chọn nhân viên.',
            'id.exists'                   => 'Nhân viên đã chọn không hợp lệ.',
        ];
    }
}
