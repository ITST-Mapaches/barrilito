<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('idCliente');
            $table->string('nombre', 50);
            $table->string('apellidoPaterno', 50);
            $table->string('apellidoMaterno', 50);
            $table->String('rfc', 13);
            $table->String('telefono', 15);
            $table->String('correo')->array_unique();
            $table->String('direccion');
            $table->integer('idProducto')->unsigned();
            //indica que idProducto es una llave foranea, referencia a la comuna idProducto de la tabla productos
            $table->foreign('idProducto')->references('idProducto')->on('productos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
