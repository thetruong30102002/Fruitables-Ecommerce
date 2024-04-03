<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

            'email' => 'required|string|email|unique:users,email,'.$this->id.'|max:191',
            'name' => 'required|string',
            'user_catelogue_id' => 'required|integer|gt:0',

        ];
    }
    public function messages(): array
    {
        return [
            'email.email' => 'Email không hợp lệ VD: abc@gmail.com',
            'email.unique' => 'Email đã tồn tại. Hãy chọn email khác',
            'email.string' => 'Email phải là dạng ký tự',
            'email.max' => 'Email độ dài tối đa 191 ký tự',
            'email.required' => 'Email không được trống',
            'name.required' => 'Bạn chưa nhập họ tên',
            'name.string' => 'Họ tên phải là dạng ký tự',
            'user_catelogue_id.gt' => 'Bạn chưa chọn nhóm thành viên',
            
        ];
    }
}
