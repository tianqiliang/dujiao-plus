<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Http\Request;

class JwtMiddleware
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
        try {

            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            if ($e instanceof TokenInvalidException) {
                return response()->json(['message' => 'token 无效', 'status' => false, 'code' => 403], 403);
            } elseif ($e instanceof TokenExpiredException) {
                return response()->json(['message' => 'Token 过期', 'status' => false, 'code' => 402], 402);
            } else {
                return response()->json(['message' => '未找到授权令牌', 'status' => false, 'code' => 404], 404);
            }
            return response()->json(['status' => false], 404);
        }
        return $next($request);
    }
}
