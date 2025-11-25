<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('t_productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignId('category_id')->constrained('categories');
            $table->integer('stock')->default(0);
            $table->decimal('precio', 10, 2);
            $table->enum('estado', ['A','I'])->default('A');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('t_productos');
    }
};
