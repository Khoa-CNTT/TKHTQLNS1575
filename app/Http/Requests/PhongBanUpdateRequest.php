<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhongBanUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id'               => 'required|exists:phong_bans,id',
            'ten_phong_ban'    => 'required|min:6|max:100|unique:phong_bans,ten_phong_ban,' . $this->id,
            'id_phong_ban_cha' => 'required|exists:phong_bans,id',
            'id_truong_phong'  => 'required|exists:nhan_viens,id',
            'tinh_trang'       => 'required|boolean',
        ];
    }
    public function messages()
    {
        return [
            'id.required'               => 'Phòng ban cần cập nhật không được để trống.',
            'id.exists'                 => 'Phòng ban không tồn tại trong hệ thống.',
            'ten_phong_ban.required'    => 'Tên phòng ban không được để trống.',
            'ten_phong_ban.min'         => 'Tên phòng ban phải có ít nhất 6 ký tự.',
            'ten_phong_ban.max'         => 'Tên phòng ban không được vượt quá 100 ký tự.',
            'ten_phong_ban.unique'      => 'Tên phòng ban đã tồn tại.',
            'id_phong_ban_cha.required' => 'Phòng ban cha không được để trống.',
            'id_phong_ban_cha.exists'   => 'Phòng ban cha không tồn tại trong hệ thống.',
            'id_truong_phong.required'  => 'Trưởng phòng không được để trống.',
            'id_truong_phong.exists'    => 'Trưởng phòng không tồn tại trong hệ thống.',
            'tinh_trang.required'       => 'Tình trạng không được để trống.',
            'tinh_trang.boolean'        => 'Tình trạng phải là hiển thị hoặc tạm tắt',
        ];
    }
}
