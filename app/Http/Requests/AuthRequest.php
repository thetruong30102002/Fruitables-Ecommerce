<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
            
                'email' => 'required|email',
                'password'=> 'required',
            
        ];
    }
    public function messages(): array
    {
        return [
            'email.email' => 'Email không hợp lệ VD: abc@gmail.com',
           'email.required' => 'Email không được trống',
            'password.required' => 'Mật khẩu không được trống',
        ];
    }
}
