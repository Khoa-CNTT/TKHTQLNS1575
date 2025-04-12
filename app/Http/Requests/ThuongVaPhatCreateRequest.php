<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThuongVaPhatCreateRequest extends FormRequest
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
            'id_quy_dinh'  => 'required|exists:quy_dinh_cho_diems,id',
            'ly_do'        => 'required|min:6|max:150',
        ];
    }

    public function messages(): array
    {
        return [
            'id_nhan_vien.required' => 'Nhân viên không được để trống!',
            'id_nhan_vien.exists'   => 'Nhân viên không tồn tại!',
            'id_quy_dinh.required'  => 'Quy định không được để trống!',
            'id_quy_dinh.exists'    => 'Quy định không tồn tại!',
            'ly_do.required'        => 'Lý do không được để trống!',
            'ly_do.min'             => 'Lý do phải có ít nhất 6 ký tự!',
            'ly_do.max'             => 'Lý do không được vượt quá 150 ký tự!',
        ];
    }
}
