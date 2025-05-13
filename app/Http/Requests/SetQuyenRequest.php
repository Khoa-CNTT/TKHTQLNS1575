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
            'id_chuc_vu'  =>  'required|exists:chuc_vus,id',
            'id'            =>  'required|exists:chuc_nangs,id',
        ];
    }

    public function messages()
    {
        return [
            'id_chuc_vu.required' => 'Nhân viên được không được để trống',
            'id_chuc_vu.exists'   => 'Nhân viên này không tồn tại trong hệ thống',
            'id.required'           => 'Chức năng không được để trống',
            'id.exists'             => 'Chức năng này không tồn tại trong hệ thống',
        ];
    }
}
