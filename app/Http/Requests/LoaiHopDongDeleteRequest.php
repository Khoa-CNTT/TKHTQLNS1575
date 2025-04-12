<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoaiHopDongDeleteRequest extends FormRequest
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
            'id' => 'required|exists:loai_hop_dongs,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Loại hợp đồng không được để trống!',
            'id.exists'   => 'Loại hợp đồng không tồn tại!',
        ];
    }
}
