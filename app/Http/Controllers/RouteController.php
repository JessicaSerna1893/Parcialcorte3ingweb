<?php

namespace App\Http\Controllers;

use App\Models\Ruta;
use Illuminate\Http\Request;

class RouteController extends Controller {

    public function store(Request $req) {
        $data = $req->validate([
            'path' => 'required',
            'method' => 'required',
            'scope' => 'nullable'
        ]);

        $ruta = Ruta::create($data);
        return response()->json($ruta);
    }

    public function assignRole(Request $req) {
        $req->validate([
            'ruta_id' => 'required|exists:rutas,id',
            'role_id' => 'required|exists:roles,id'
        ]);

        $ruta = Ruta::find($req->ruta_id);
        $ruta->roles()->attach($req->role_id);

        return response()->json(['message' => 'Asignado']);
    }
}
