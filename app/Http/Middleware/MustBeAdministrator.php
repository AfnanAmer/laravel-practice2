<?php

namespace App\Http\Middleware;




use Closure;
use Symfony\Component\HttpFoundation\Response;
// use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;




class MustBeAdministrator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // if (auth()->user()?->username !== 'mee') {
        //     abort('403'); 
        // }
        abort_if(auth()->user()?->username !== 'mee', Response::HTTP_FORBIDDEN);
        return $next($request);
    }
}
