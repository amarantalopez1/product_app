<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Models\AccessToken;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;


class EnsureTokenIsValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        try {
            $token = JWTAuth::getToken();
            logger()->info('Token: ' . $token);
            $user = JWTAuth::parseToken()->authenticate();
            if (!$user) {
                return response()->json(['error' => 'User not found'], 404);
            }
            if (!AccessToken::where('token', $token)->exists()) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }
        } catch (Exception $e) {
            logger()->error('Error: ' . $e->getMessage());
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    
        return $next($request);
    }
}
