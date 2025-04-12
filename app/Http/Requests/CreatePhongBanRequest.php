<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePhongBanRequest extends FormRequest
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
            'ten_phong_ban'         => 'required|min:3',
            'id_phong_ban_cha'      => 'required',
            'id_truong_phong'       => 'required',
            'tinh_trang'            => 'required',
        ];
    }
    public function messages()
    {
        return [
            'ten_phong_ban.*'       => 'Tên phòng ban phải nhập và tối thiểu 3 kí tự',
            'id_phong_ban_cha.*'    => 'Tên phòng ban cha phải nhập',
            'id_truong_phong.*'     => 'Tên trưởng phòng phải nhập',
            'tinh_trang.*'          => 'Tình trạng chưa được chọn',
        ];
    }
}
