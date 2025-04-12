<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThuongVaPhatDeleteRequest extends FormRequest
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
            'id' => 'required|exists:thuong_va_phats,id',
        ];
    }
    public function messages()
    {
        return [
            'id.required' => 'Thưởng và phạt không được để trống.',
            'id.exists'   => 'Thưởng và phạt không tồn tại trong hệ thống.',
        ];
    }
}
