<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticateMiddleware
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
        if ((Auth::user()->role == 0)) {
            return redirect('/')->with('error', 'Bạn không có quyền truy cập.Vui lòng đăng nhập tài khoản khác');
        }
        return $next($request);
    }
}
