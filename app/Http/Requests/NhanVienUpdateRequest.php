<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NhanVienUpdateRequest extends FormRequest
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
            'id_phong_ban'          =>  'required|exists:phong_bans,id',
            'id_chuc_vu'            =>  'required|exists:chuc_vus,id',
            'ho_va_ten'             =>  'required|min:2',
            'email'                 =>  'required|email|unique:nhan_viens,email,' .$this->id,
            'ngay_sinh'             =>  'required|date',
            'dia_chi'               =>  'required|min:6',
            'so_dien_thoai'         =>  'required|digits:10',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required'                 => 'Vui lòng chọn nhân viên.',
            'id.exists'                   => 'Nhân viên đã chọn không hợp lệ.',

            'id_phong_ban.required'       => 'Vui lòng chọn phòng ban.',
            'id_phong_ban.exists'         => 'Phòng ban đã chọn không hợp lệ.',

            'id_chuc_vu.required'         => 'Vui lòng chọn chức vụ.',
            'id_chuc_vu.exists'           => 'Chức vụ đã chọn không hợp lệ.',

            'ho_va_ten.required'          => 'Vui lòng nhập họ và tên.',
            'ho_va_ten.min'               => 'Họ và tên phải có ít nhất :min ký tự.',

            'email.required'              => 'Vui lòng nhập địa chỉ email.',
            'email.email'                 => 'Địa chỉ email không hợp lệ.',
            'email.unique'                => 'Địa chỉ email đã tồn tại.',

            'ngay_sinh.required'          => 'Vui lòng nhập ngày sinh.',
            'ngay_sinh.date'              => 'Ngày sinh không hợp lệ.',

            'dia_chi.required'            => 'Vui lòng nhập địa chỉ.',
            'dia_chi.min'                 => 'Địa chỉ phải có ít nhất :min ký tự.',

            'so_dien_thoai.required'      => 'Vui lòng nhập số điện thoại.',
            'so_dien_thoai.digits'        => 'Số điện thoại phải có :digits chữ số.',
        ];
    }
}
