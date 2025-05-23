<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LayLaiMatKhauRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'password'              => 'required|min:6|max:50',
            're_password'           => 'required|same:password',
           'old_password' => ['required', function ($attribute, $value, $fail) {
            $user = Auth::guard('sanctum')->user();
                    if (!$user || !Hash::check($value, $user->password)) {
                        $fail('Mật khẩu cũ không đúng');
                    }
                }]
        ];
    }

    public function messages()
    {
        return [
            'password.*'              => 'Mật khẩu không được để trống và từ 6 đến 30 ký tự',
            're_password.*'           => 'Nhập lại mật khẩu không trùng với mật khẩu',
            'old_password.*'          => 'Mật khẩu cũ không đúng',
        ];
    }
}
