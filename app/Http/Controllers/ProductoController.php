<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller {

    // CUS4 + CUS5 paginación
    public function index(Request $req) {
        $perPage = $req->query('per_page', 10);
        $page = $req->query('page', 1);

        $query = Producto::query();

        if ($q = $req->query('q')) {
            $query->where('nombre', 'like', "%$q%");
        }

        return $query->paginate($perPage, ['*'], 'page', $page);
    }

    public function store(Request $req) {
        $data = $req->validate([
            'nombre' => 'required',
            'category_id' => 'required|exists:categories,id',
            'stock' => 'required|integer',
            'precio' => 'required|numeric',
            'estado' => 'required|in:A,I'
        ]);

        return Producto::create($data);
    }

    public function show($id) {
        return Producto::findOrFail($id);
    }

    public function update(Request $req, $id) {
        $p = Producto::findOrFail($id);
        $p->update($req->only(['nombre','category_id','precio','estado']));
        return $p;
    }

    public function destroy($id) {
        Producto::findOrFail($id)->delete();
        return response()->json(['message' => 'Eliminado']);
    }

    // CUS6 sum/restar stock
    public function updateStock(Request $req, $id) {
        $req->validate(['cantidad' => 'required|integer']);

        $p = Producto::findOrFail($id);
        $cantidad = $req->cantidad;

        if ($cantidad < $p->stock) {
            $p->stock -= $cantidad;
        } else {
            $p->stock += $cantidad;
        }

        $p->save();
        return $p;
    }
}
