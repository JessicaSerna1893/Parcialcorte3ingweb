<?php

namespace App\Soap;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserServiceSoap {

    public function createUser($name, $email, $password, $role) {
        $r = Role::where('name', $role)->first();

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role_id' => $r->id
        ]);

        return ['status' => true, 'user_id' => $user->id];
    }

    public function login($email, $password) {
        $credentials = ['email' => $email, 'password' => $password];

        if (!$token = auth('api')->attempt($credentials)) {
            return ['status' => false, 'message' => 'Credenciales inválidas'];
        }
        $ttl = (int) auth('api')->factory()->getTTL();
        return [
            'status' => true,
            'access_token' => $token,
            'expires_in' => $ttl * 60
        ];
    }

    public function validateToken($token) {
        try {
            $payload = JWTAuth::setToken($token)->getPayload();
            return ['valid' => true];
        } catch (\Exception $e) {
            return ['valid' => false];
        }
    }
}
