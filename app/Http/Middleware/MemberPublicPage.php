<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\member\LoginModel;
Use Session;
class MemberPublicPage
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
        if(Session::has('loginID')){
            $user = LoginModel::where('client_id', '=', session('loginID'))->first();
            if(isset($user)){
            return redirect("/".config('app.member_folder')."/dashboard");
            }
        }
        return $next($request);
    }
}
