<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::id() == null) {
            return redirect('/signin')->with('error', ' Bạn phải đăng nhập');
        }
        if ((Auth::user()->role != 2)) {
            return redirect('/admin')->with('error', 'Bạn không có quyền truy cập.Vui lòng đăng nhập tài khoản khác');
        }
        return $next($request);
    }
}
