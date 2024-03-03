<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosModel extends Model
{
    use HasFactory;

    //primary key de la tabla
    protected $primaryKey = "idProducto";

    //nombre de la tabla en la base de datos
    protected $table = "productos";

    //columnas de la tabla
    protected $fillable = [
        "nombre",
        "descripcion",
        "precio",
        "expiracion",
        "stock",
        "idProveedor",
    ];
}
