<?php

namespace App\Http\Middleware;

use Closure;
use Auth;


class CheckUserSistema
{

    protected $redirectTo;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   //si se pudo loguear y es usuario del sistema diera
        if (Auth::check() && Auth::user()->level() > 0) { 
            return $next($request);
        }  
        //si no es usuario de diera, cerramos la sesion y pedimos login de nuevo.
        Auth::logout();
        toastr()->error('Contacte con el administrador!!!', 'Usuario no habilitado en sistema de carga de Relevamientos de la DIE'
                        ,['timeOut' => 5000, 'positionClass' => 'toast-top-center']);
        return redirect()->route('login'); //abort (403);                
         
    }
}