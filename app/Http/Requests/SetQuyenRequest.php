<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SetQuyenRequest extends FormRequest
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
            'id_nhan_vien'  =>  'required|exists:nhan_viens,id',
            'id'            =>  'required|exists:chuc_nangs,id',
        ];
    }

    public function messages()
    {
        return [
            'id_nhan_vien.required' => 'Nhân viên được không được để trống',
            'id_nhan_vien.exists'   => 'Nhân viên này không tồn tại trong hệ thống',
            'id.required'           => 'Chức năng không được để trống',
            'id.exists'             => 'Chức năng này không tồn tại trong hệ thống',
        ];
    }
}
