<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MustBeAdministrator
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
       /* if (auth()->user()?->username !== 'simo') {
            abort(Response::HTTP_FORBIDDEN);
        }*/ // php 8 version

        if (auth()->user()->username !== 'simo') {
            abort(Response::HTTP_FORBIDDEN);
        }

        //abort_if(auth()->user()->username !== 'simo', Response::HTTP_FORBIDDEN);

        return $next($request);
    }
}
