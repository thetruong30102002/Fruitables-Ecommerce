<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function __construct()
    {
    }
    public function index()
    {

        return view('backend.auth.login');
    }
    public function login(Request $request)
    {
        $messages = [
            'email.email' => 'Email không hợp lệ VD: abc@gmail.com',
            'email.required' => 'Email không được trống',
            'password.required' => 'Mật khẩu không được trống',
        ];
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], $messages);

        $credentials = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        if (Auth::attempt( $credentials)) {
            return redirect('/')->with('success', 'Đặng nhập thành công');
        }
        return redirect('/signin')->with('error', '
        Email hoặc mật khẩu không hợp lệ ');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Đăng xuất thành công');
    }
    public function signup()
    {

        return view('backend.auth.signup');
    }
    public function signupp(Request $request)
    {
        $messages = [
            'email.email' => 'Email không hợp lệ VD: abc@gmail.com',
            'email.unique' => 'Email đã tồn tại. Hãy chọn email khác',
            'email.string' => 'Email phải là dạng ký tự',
            'email.max' => 'Email độ dài tối đa 191 ký tự',
            'email.required' => 'Email không được trống',
            'password.required' => 'Mật khẩu không được trống',
            're_password.required' => 'Bạn phải nhập vào ô mật khẩu',
            're_password.same' => 'Mật khẩu không khớp',
        ];
        $validated = $request->validate([
            'email' => 'required|string|email|unique:users|max:191',
            'password' => 'required|string|min:6',
            're_password' => 'required|string|same:password',
        ], $messages);
        User::create([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);
        return  redirect('/signin')->with('success', 'Đăng ký thành công vui lòng đăng nhập');
    }
}
