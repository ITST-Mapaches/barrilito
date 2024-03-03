<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedoresModel extends Model
{
    use HasFactory;
    //primary key de la tabla
    protected $primaryKey = "idProveedor";

    //nombre de la tabla en la base de datos
    protected $table = "proveedores";

    //columnas de la tabla
    protected $fillable = [
        "razonSocial",
        "nombreCompleto",
        "direccion",
        "telefono",
        "correo",
        "rfc",
    ];
}
