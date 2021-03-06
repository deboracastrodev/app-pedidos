<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Exceptions\{TokenExpiredException, TokenInvalidException};

class ApiProtectedRoute extends BaseMiddleware
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
      try {
        $user = JWTAuth::parseToken()->authenticate();
      } catch (Exception $exception) {
        if ($exception instanceof TokenInvalidException){
          return response()->json(['status' => 'Token inválido']);
        }else if ($exception instanceof TokenExpiredException){
          return response()->json(['status' => 'Token expirado']);
        }else{
          return response()->json(['status' => 'Autorização não encontrada']);
        }
      }

      return $next($request);
    }
}