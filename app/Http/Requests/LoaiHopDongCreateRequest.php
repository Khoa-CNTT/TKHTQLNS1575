<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoaiHopDongCreateRequest extends FormRequest
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
            'ten_hop_dong' => 'required|min:6|max:100|unique:loai_hop_dongs,ten_hop_dong',
            'noi_dung'     => 'required|min:100|max:2000',
            'tinh_trang'   => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'ten_hop_dong.required' => 'Tên hợp đồng không được để trống!',
            'ten_hop_dong.min'      => 'Tên hợp đồng phải có ít nhất 6 ký tự!',
            'ten_hop_dong.max'      => 'Tên hợp đồng không được vượt quá 100 ký tự!',
            'ten_hop_dong.unique'   => 'Tên hợp đồng đã tồn tại!',
            'noi_dung.required'     => 'Nội dung không được để trống!',
            'noi_dung.min'          => 'Nội dung phải có ít nhất 100 ký tự!',
            'noi_dung.max'          => 'Nội dung không được vượt quá 2000 ký tự!',
            'tinh_trang.required'   => 'Tình trạng không được để trống!',
            'tinh_trang.boolean'    => 'Tình trạng phải là hiển thị hoặc tạm tắt!',
        ];
    }
}
