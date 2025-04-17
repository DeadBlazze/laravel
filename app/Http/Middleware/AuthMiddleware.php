<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        try{
            $token = JWTAuth::parseToken();
            $payload = $token->getPayload();
        } catch (\Exception $e) {
            return response()->json(['err' => 'Ошибка авторизации: ' . $e->getMessage()], 401);
        }
        $request->attributes->add(["payload"=> $payload]);
        return $next($request);
    }
}
