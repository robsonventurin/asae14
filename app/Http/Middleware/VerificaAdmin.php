<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class VerificaAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->ehAdmin()) {
            session(['mensagem'=>'Ooops, para acessar esta página você precisa ser administrador.']);
            return back();
        }
        return $next($request);
    }
}
