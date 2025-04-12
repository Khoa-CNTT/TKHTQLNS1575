<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QDCDUpdateRequest extends FormRequest
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
            'id'         => 'required|exists:quy_dinh_cho_diems,id',
            'ma_so'      => 'required|min:6|max:255|unique:quy_dinh_cho_diems,ma_so,' . $this->id,
            'noi_dung'   => 'required|min:6|max:150',
            'so_diem'    => 'required|numeric',
            'loai_diem'  => 'required|in:0,1',
            'tinh_trang' => 'required|boolean',
            'ghi_chu'    => 'required|min:6|max:150',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required'        => 'Quy định cần cập nhật không được để trống!',
            'id.exists'          => 'Quy định cần cập nhật không tồn tại!',
            'ma_so.required'     => 'Mã số không được để trống!',
            'ma_so.min'          => 'Mã số phải có ít nhất 6 ký tự!',
            'ma_so.max'          => 'Mã số không được vượt quá 255 ký tự!',
            'ma_so.unique'       => 'Mã số đã tồn tại!',
            'noi_dung.required'  => 'Nội dung không được để trống!',
            'noi_dung.min'       => 'Nội dung phải có ít nhất 6 ký tự!',
            'noi_dung.max'       => 'Nội dung không được vượt quá 150 ký tự!',
            'so_diem.required'   => 'Số điểm không được để trống!',
            'so_diem.numeric'    => 'Số điểm phải là số!',
            'loai_diem.required' => 'Loại điểm không được để trống!',
            'loai_diem.in'       => 'Loại điểm phải là thưởng hoặc phạt!',
            'tinh_trang.required'=> 'Tình trạng không được để trống!',
            'tinh_trang.boolean' => 'Tình trạng phải là hiển thị hoặc tạm tắt!',
            'ghi_chu.required'   => 'Ghi chú không được để trống!',
            'ghi_chu.min'        => 'Ghi chú phải có ít nhất 6 ký tự!',
            'ghi_chu.max'        => 'Ghi chú không được vượt quá 150 ký tự!',
        ];
    }
}
