<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NhanVienRequest extends FormRequest
{

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
            'ho_va_ten' => 'required|string|max:255',
            'ngay_sinh' => 'required|date',
            'gioi_tinh' => 'required|boolean',
            'so_dien_thoai' => 'required|string|max:15',
            'email' => 'required|email|unique:nhan_viens,email',
            'password' => 'required|string|min:8',
            'ngay_tuyen_dung' => 'required|date',
            'ma_phong_ban' => 'required',
            'ma_chuc_danh' => 'required',
            'trang_thai' => 'required|boolean',
            'loai_hop_dong' => 'required|string|max:255',
            'is_master' => 'required|boolean',
            'ma_vai_tro' => 'required',


        ];
    }
    public function messages(): array
    {
        return [
            'ho_va_ten.required' => 'Họ và tên là bắt buộc.',
            'ho_va_ten.string' => 'Họ và tên phải là chuỗi.',
            'ho_va_ten.max' => 'Họ và tên không được vượt quá 255 ký tự.',
            'ngay_sinh.required' => 'Ngày sinh là bắt buộc.',
            'ngay_sinh.date' => 'Ngày sinh phải là ngày.',
            'gioi_tinh.required' => 'Giới tính là bắt buộc.',
            'gioi_tinh.boolean' => 'Giới tính phải là boolean.',
            'so_dien_thoai.required' => 'Số điện thoại là bắt buộc.',
            'so_dien_thoai.string' => 'Số điện thoại phải là chuỗi.',
            'so_dien_thoai.max' => 'Số điện thoại không được vượt quá 15 ký tự.',
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là chuỗi.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'ngay_tuyen_dung.required' => 'Ngày tuyển dụng là bắt buộc.',
            'ngay_tuyen_dung.date' => 'Ngày tuyển dụng phải là ngày.',
            'ma_phong_ban.required' => 'Mã phòng ban là bắt buộc.',
            'ma_chuc_danh.required' => 'Mã chức danh là bắt buộc.',
            'trang_thai.required' => 'Trạng thái là bắt buộc.',
            'trang_thai.boolean' => 'Trạng thái phải là boolean.',
            'loai_hop_dong.required' => 'Loại hợp đồng là bắt buộc.',
            'loai_hop_dong.string' => 'Loại hợp đồng phải là chuỗi.',
            'loai_hop_dong.max' => 'Loại hợp đồng không được vượt quá 255 ký tự.',
            'is_master.required' => 'Trạng thái là bắt buộc.',
            'is_master.boolean' => 'Trạng thái phải là boolean.',
            'ma_vai_tro.required' => 'Mã vai trò là bắt buộc.',
        ];
    }
}
