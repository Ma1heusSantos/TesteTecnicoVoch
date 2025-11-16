<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAccess
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Você precisa estar logado.');
        }

        if (Auth::user()->role !== 'admin') {
            //return abort(403, 'Acesso negado. Somente administradores podem acessar esta área.');
            return redirect()->route('economicGroup.show');
        }

        return $next($request);
    }
}
