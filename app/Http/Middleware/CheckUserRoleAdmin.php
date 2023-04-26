<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRoleAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {   
        if(auth()->check() && auth()->user()->roles->name == "admin")
        {            
            return $next($request);
        }        

        abort(403, 'This page doesnt exists.');
    }
}

/*
Closure $next is a parameter declaration in a middleware's handle method.
In Laravel middleware, $next is a callable that represents the next middleware or the final route handler that the current request should be passed to.
A Closure is a type of anonymous function in PHP. It allows you to create a function on the fly and pass it around as a variable.
In the middleware handle method, the $next parameter is a reference to the next middleware or the final route handler in the pipeline. 
The handle method should call this $next closure in order to continue the request to the next middleware or the final route handler.
So, when you call $next($request) inside the middleware, Laravel will pass the request to the next middleware or the final route handler in the pipeline.
*/