<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class ValidateJwt {

    public function handle($request, Closure $next) {
        try {
        JWTAuth::parseToken()->authenticate();
    } catch (TokenInvalidException $e) {
        return response()->json(['message' => 'Token inválido'], 401);
    } catch (TokenExpiredException $e) {
        return response()->json(['message' => 'Token expirado'], 401);
    } catch (JWTException $e) {
        return response()->json(['message' => 'Token no encontrado'], 401);
    }

    return $next($request);
    }
}
