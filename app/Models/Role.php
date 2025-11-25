<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
    protected $fillable = ['name','description'];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function rutas() {
        return $this->belongsToMany(Ruta::class, 'ruta_role');
    }
}
