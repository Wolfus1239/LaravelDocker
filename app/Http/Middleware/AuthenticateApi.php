<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $bearer_token = $request->bearerToken();
        if(!empty($bearer_token)){
            $db_token = DB::table('users')->where('api_token', '=',$bearer_token)->first();
            if(!empty($db_token)){
                if($db_token->api_token == $bearer_token){
                    return $next($request);
                }
            }
        }
    }
}
