<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientesModel extends Model
{
    use HasFactory;

    //primary key de la tabla
    protected $primaryKey = "idCliente";

    //nombre de la tabla en la base de datos
    protected $table = "clientes";

    //columnas de la tabla
    protected $fillable = [
        "nombre",
        "apellidoPaterno",
        "apellidoMaterno",
        "rfc",
        "telefono",
        "correo",
        "direccion",
        "idProducto",
    ];
}
