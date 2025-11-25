<?php

namespace App\Http\Middleware;

use Closure;
use Exception;

class CheckScope
{
    public function handle($request, Closure $next, $requiredScope = null)
    {
        $token = $request->bearerToken();
        if (!$token) {
            return response()->json(['message' => 'Token no enviado'], 401);
        }
        $client = new \GuzzleHttp\Client(['base_uri' => env('USER_SERVICE_URL')]);
        try {
            $res = $client->post('/api/validate-token', [
                'json' => ['token' => $token]
            ]);
            $data = json_decode($res->getBody(), true);
            if (!$data['valid']) {
                return response()->json(['message' => 'Token inválido o expirado'], 401);
            }
            if ($requiredScope) {
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error validando token'], 500);
        }
        
        return $next($request);
    }
}
