<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChucVuDeleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id' => 'required|exists:chuc_vus,id',
        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Chức vụ cần xóa không được để trống.',
            'id.exists'   => 'Chức vụ không tồn tại trong hệ thống.',
        ];
    }

}
