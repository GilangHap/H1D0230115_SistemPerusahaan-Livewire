<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        
        $pegawai = Auth::user();
        
        // Debug log
        Log::info('Role middleware check', [
            'required_role' => $role,
            'pegawai_id' => $pegawai->id,
            'has_jabatan' => $pegawai->jabatan ? true : false,
            'has_role' => $pegawai->jabatan && $pegawai->jabatan->role ? true : false,
            'pegawai_role' => $pegawai->jabatan && $pegawai->jabatan->role ? $pegawai->jabatan->role->name : 'none'
        ]);
        
        // Check if user has jabatan and role
        if (!$pegawai->jabatan || !$pegawai->jabatan->role) {
            return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki jabatan atau role yang sesuai.');
        }
        
        // Check if user's role matches the required role
        if ($pegawai->jabatan->role->name === $role) {
            return $next($request);
        }
        
        // If role doesn't match, redirect to their corresponding dashboard
        switch ($pegawai->jabatan->role->name) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'atasan':
                return redirect()->route('atasan.dashboard');
            case 'staff':
                return redirect()->route('staff.dashboard');
            default:
                return redirect()->route('dashboard');
        }
    }
}