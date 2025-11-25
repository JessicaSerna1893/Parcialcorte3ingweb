<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RouteController;
use App\Soap\UserServiceSoap;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/validate-token', [AuthController::class, 'validateToken']);

Route::post('/rutas', [RouteController::class, 'store']);
Route::post('/rutas/assign', [RouteController::class, 'assignRole']);

Route::middleware(['jwt.validate'])->group(function () {

    Route::get('/productos', [ProductoController::class, 'index']);
    Route::post('/productos', [ProductoController::class, 'store']);
    Route::get('/productos/{id}', [ProductoController::class, 'show']);
    Route::put('/productos/{id}', [ProductoController::class, 'update']);
    Route::delete('/productos/{id}', [ProductoController::class, 'destroy']);

    Route::post('/productos/{id}/stock', [ProductoController::class, 'updateStock']);
});


Route::any('/soap', function() {
    $server = new SoapServer(null, ['uri' => url('/')]);
    $server->setClass(UserServiceSoap::class);
    $server->handle();
});
