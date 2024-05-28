<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
Use Session;

class MemberProtectedPage
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
       
        if(!Session::has('loginID')){
            return redirect("/".config('app.member_folder')."/login");
        }

        return $next($request);
    }
}
