<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use \Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use \Tymon\JWTAuth\Facades\JWTAuth;
use \Tymon\JWTAuth\Exceptions\TokenInvalidException;
use \Tymon\JWTAuth\Exceptions\TokenExpiredException;
USE \Tymon\JWTAuth\Exceptions\JWTException;

class apiProtecaoRotas extends BaseMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $exception) {
            if ($exception instanceof TokenInvalidException) {
                return response()->json(['status' => 'Token de acesso invalida']);
            } else if ($exception instanceof TokenExpiredException) {
                return response()->json(['status' => 'Token expirada']);
            } else {
                return response()->json(['status' => 'Erro ao autenticar a Token']);
            }
        }
        return $next($request);
    }

}
