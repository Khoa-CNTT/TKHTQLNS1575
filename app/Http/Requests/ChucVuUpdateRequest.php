<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChucVuUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'id'          => 'required|exists:chuc_vus,id',
            'ten_chuc_vu' => 'required|min:6|max:100|unique:chuc_vus,ten_chuc_vu,' . $this->id,
            'tinh_trang'  => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'id.required'          => 'Chức vụ cần cập nhật không được để trống.',
            'id.exists'            => 'Chức vụ không tồn tại trong hệ thống.',
            'ten_chuc_vu.required' => 'Tên chức vụ không được để trống.',
            'ten_chuc_vu.min'      => 'Tên chức vụ phải có ít nhất 6 ký tự.',
            'ten_chuc_vu.max'      => 'Tên chức vụ không được vượt quá 100 ký tự.',
            'ten_chuc_vu.unique'   => 'Tên chức vụ này đã được sử dụng.',
            'tinh_trang.required'  => 'Tình trạng không được để trống.',
            'tinh_trang.boolean'   => 'Tình trạng phải là hiển thị hoặc tạm tắt',
        ];
    }

}
