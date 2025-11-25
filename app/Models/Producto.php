<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model {
    protected $table = "t_productos";

    protected $fillable = [
        'nombre',
        'category_id',
        'stock',
        'precio',
        'estado'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }
}
