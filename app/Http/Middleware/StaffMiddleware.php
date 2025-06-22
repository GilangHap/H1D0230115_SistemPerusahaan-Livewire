<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Periksa apakah user sudah login dan memiliki role staff melalui relasi
        if (Auth::check() && Auth::user()->hasRole('staff')) {
            return $next($request);
        }
        
        // Jika bukan staff, redirect sesuai role mereka atau ke halaman login
        if (Auth::check()) {
            $user = Auth::user();
            
            if ($user->hasRole('admin')) {
                return redirect()->route('admin.dashboard');
            } elseif ($user->hasRole('atasan')) {
                return redirect()->route('atasan.dashboard');
            }
            
            // Jika user tidak memiliki role yang valid, arahkan ke halaman default
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki role yang valid.');
        }
        
        // Jika tidak login sama sekali, redirect ke login
        return redirect()->route('login')->with('error', 'Anda tidak memiliki akses ke halaman tersebut.');
    }
}