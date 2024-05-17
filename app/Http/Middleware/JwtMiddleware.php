<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Exception;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = $request->bearerToken();
            if ($token) {
                return $next($request);
            } else {
                return response()->json([
                    "status"  => "error",
                    "message" => "缺少 bearer token"
                ], 401);
            }
        } catch (Exception $e) {
            return response()->json([
                "status"  => "error",
                "message" => "token 錯誤"
            ], 401);
        } 
    }
}
