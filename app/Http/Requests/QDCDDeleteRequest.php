<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QDCDDeleteRequest extends FormRequest
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
            'id' => 'required|exists:quy_dinh_cho_diems,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Quy đinh cần xóa không được để trống!',
            'id.exists'   => 'Quy đinh cần xóa không tồn tại!',
        ];
    }
}
