<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NhanVienCreateHopDongRequest extends FormRequest
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
            'id'                 => 'required|exists:nhan_viens,id',
            'id_loai_hop_dong'   => 'required|exists:loai_hop_dongs,id',
            'noi_dung'           => 'required|min:10',
            'ngay_ky'            => 'required|date',
            'ngay_bat_dau'       => 'required|date|after_or_equal:ngay_ky',
            'ngay_ket_thuc'      => 'required|date|after:ngay_bat_dau',
        ];
    }

    public function messages(): array
{
    return [
        'id.required'                 => 'Vui lòng chọn nhân viên.',
        'id.exists'                   => 'Nhân viên đã chọn không hợp lệ.',

        'id_loai_hop_dong.required'   => 'Vui lòng chọn loại hợp đồng.',
        'id_loai_hop_dong.exists'     => 'Loại hợp đồng đã chọn không hợp lệ.',

        'noi_dung.required'           => 'Vui lòng nhập nội dung hợp đồng.',
        'noi_dung.min'                => 'Nội dung hợp đồng phải có ít nhất :min ký tự.',

        'ngay_ky.required'            => 'Vui lòng nhập ngày ký hợp đồng.',
        'ngay_ky.date'                => 'Ngày ký không hợp lệ.',

        'ngay_bat_dau.required'       => 'Vui lòng nhập ngày bắt đầu hợp đồng.',
        'ngay_bat_dau.date'           => 'Ngày bắt đầu không hợp lệ.',
        'ngay_bat_dau.after_or_equal' => 'Ngày bắt đầu phải sau hoặc bằng ngày ký.',

        'ngay_ket_thuc.required'      => 'Vui lòng nhập ngày kết thúc hợp đồng.',
        'ngay_ket_thuc.date'          => 'Ngày kết thúc không hợp lệ.',
        'ngay_ket_thuc.after'         => 'Ngày kết thúc phải sau ngày bắt đầu.',
    ];
}
}
