<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChamCongCreateRequest extends FormRequest
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
            'id_nhan_vien'      => 'required|exists:nhan_viens,id',
            'ngay_lam_viec'     => 'required|date',
            'ca_lam'            => 'required|required|in:1,2,3',
        ];
    }
    public function messages()
    {
        return [
            'id_nhan_vien.required'     => 'Nhân viên không được để trống',
            'id_nhan_vien.exists'       => 'Nhân viên không tồn tại!',
            'ngay_lam_viec.required'    => 'Ngày làm việc không được để trống!',
            'ngay_lam_viec.date'        => 'Định dạng ngày không hợp lệ!',
            'ca_lam.required'           => 'Ca làm không được để trống!',
            'ca_lam.in'                 => 'Ca làm phải là ca sáng, ca trưa hoặc ca tối!',

        ];
    }
}
