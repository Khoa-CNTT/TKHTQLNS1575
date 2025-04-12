<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TieuChiKpiCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'ten_tieu_chi' => 'required|min:6|max:100|unique:tieu_chi_kpis,ten_tieu_chi',
            'mo_ta'        => 'required|min:6|max:150',
            'diem'         => 'required|numeric',
            'tinh_trang'   => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'ten_tieu_chi.required' => 'Tên tiêu chí không được để trống.',
            'ten_tieu_chi.min'      => 'Tên tiêu chí phải có ít nhất 6 ký tự.',
            'ten_tieu_chi.max'      => 'Tên tiêu chí không được vượt quá 100 ký tự.',
            'ten_tieu_chi.unique'   => 'Tên tiêu chí đã tồn tại.',
            'mo_ta.required'        => 'Mô tả không được để trống.',
            'mo_ta.min'             => 'Mô tả phải có ít nhất 6 ký tự.',
            'mo_ta.max'             => 'Mô tả không được vượt quá 150 ký tự.',
            'diem.required'         => 'Điểm không được để trống.',
            'diem.numeric'          => 'Điểm phải là số.',
            'tinh_trang.required'   => 'Tình trạng không được để trống.',
            'tinh_trang.boolean'    => 'Tình trạng phải là hiển thị hoặc tạm tắt.',
        ];
    }

}
