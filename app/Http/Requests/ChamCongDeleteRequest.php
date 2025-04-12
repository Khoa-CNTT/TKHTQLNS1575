<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChamCongDeleteRequest extends FormRequest
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
            'id' => 'required|exists:cham_congs,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Chấm công này không được để trống!',
            'id.exists'   => 'Chấm công này không tồn tại trong bảng chấm công!',
        ];
    }
}
