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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->increments('idProveedor');
            $table->String('razonSocial');
            $table->String('nombreCompleto');
            $table->String('direccion');
            $table->String('telefono', 20);
            $table->String('correo')->array_unique();
            $table->String('rfc', 13);
            $table->timestamps();
            //$table->tipoDato('nombreColumna');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedores');
    }
};
