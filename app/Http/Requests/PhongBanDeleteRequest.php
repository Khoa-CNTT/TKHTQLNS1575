<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhongBanDeleteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id' => 'required|exists:phong_bans,id',
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'Phòng ban cần xóa không được để trống.',
            'id.exists'   => 'Phòng ban không tồn tại trong hệ thống.',
        ];
    }

}
