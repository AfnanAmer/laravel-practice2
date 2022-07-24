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
<<<<<<< Updated upstream
        abort_if(auth()->user()?->username !== 'bsahyer', Response::HTTP_FORBIDDEN);
=======
        abort_if(auth()->user()?->username !== 'jumanah', Response::HTTP_FORBIDDEN);
>>>>>>> Stashed changes
        return $next($request);
    }
}
