<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller {

    // CUS1 Crear usuarios
    public function register(Request $req) {
        $data = $req->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $role = Role::where('name', $data['role'])->first();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $role->id
        ]);

        return response()->json($user, 201);
    }

    // CUS2 Generación de token
    public function login(Request $req) {
        $credentials = $req->only('email', 'password');

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        $ttl = (int) auth()->factory()->getTTL();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $ttl * 60
        ]);
    }

    // Endpoint REST para validación JWT
    public function validateToken(Request $req) {
        try {
            $payload = JWTAuth::setToken($req->token)->getPayload();
            return response()->json(['valid' => true, 'data' => $payload], 200);
        } catch (\Exception $e) {
            return response()->json(['valid' => false, 'message' => 'Token inválido o expirado'], 401);
        }
    }
}
