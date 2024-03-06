<?php

namespace App\Http\Controllers;

use App\Models\ProductosModel;
use App\Models\ProveedoresModel;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ProductosController extends Controller
{
    /**
     * !Muestra el módulo productos, una tabla con los productos
     */
    public function index(Request $request)
    {
        //guardamos el valor de la petición search en $search
        $search = $request->search;

        //buscamos los registros cuyo nombre o descripción que contenga el valor de la busqueda al inicio / medio o final
        // ademas los ordena de manera ascendente por su id y los pagina de 15 en 15
        $productos = ProductosModel::select('productos.*', 'proveedores.nombreCompleto as nombre_proveedor')
            ->leftJoin('proveedores', 'productos.idProveedor', '=', 'proveedores.idProveedor')
            ->where("productos.nombre", "LIKE", "%" . $search . "%")
            ->orWhere("productos.descripcion", "LIKE", "%" . $search . "%")
            ->orderBy("productos.idProducto", "asc")
            ->paginate(15);

        // evalua si se debe reestablecer la busqueda, si $search es vacio significa que no se ha hecho ninguna búsqueda
        $reestablecerBusqueda = ($search == "") ? false : true;

        //en el arreglo agregamos pares: clave - valor
        $data = [
            'search' => $search,
            'productos' => $productos,
            'reestablecerBusqueda' => $reestablecerBusqueda
        ];

        //mostramos la vista y le enviamos los registros de productos
        return view("productos/index", $data);
    }

    /**
     * !Muestra la vista con el formulario para agregar un producto
     */
    public function create()
    {
        $proveedores = ProveedoresModel::get(['idProveedor', 'nombreCompleto']);

        return view("productos/agregar/agregar", compact("proveedores"));
    }

    /**
     * !Inserta un registro en la base de datos
     */
    public function insert(Request $request)
    {

        // formateando la fecha
        $fecha = $request->input("expiracion");

        // invirtiendo el orden en el que llega la fecha de mes/dia/año a la sintaxis de mysql año-mes-día
        $fechaFormateada = Carbon::createFromFormat('m/d/Y', $fecha)->format('Y-m-d');

        //recepción de datos del formulario
        $data = [
            'nombre' => $request->input("nombre"),
            'descripcion' => $request->input("descripcion"),
            'precio' => $request->input("precio"),
            'expiracion' => $fechaFormateada,
            'stock' => $request->input("stock"),
            'idProveedor' => $request->input("idProveedor"),
        ];

        // Insersión del nuevo regristro en la base de datos
        ProductosModel::create($data);

        //redirecciona a la pagina productos
        return redirect()->route('productos');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //buscamos el producto
        $producto = ProductosModel::find($id);

        // formateando la fecha
        $fecha = $producto->expiracion;

        // invirtiendo el orden en el que llega la fecha de mes/dia/año a la sintaxis de mysql año-mes-día
        $fechaFormateada = Carbon::createFromFormat('Y-m-d', $fecha)->format('m/d/Y');

        //buscamos los proveedores
        $proveedores = ProveedoresModel::get(['idProveedor', 'nombreCompleto']);


        $data = [
            'producto' => $producto,
            'proveedores' => $proveedores,
            'expiracion' => $fechaFormateada,
        ];

        //retorna la vista para actualizar y envia resultado de la busqueda
        return view('productos/editar/editar', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // formateando la fecha
        $fecha = $request->input("expiracion");

        // invirtiendo el orden en el que llega la fecha de mes/dia/año a la sintaxis de mysql año-mes-día
        $fechaFormateada = Carbon::createFromFormat('m/d/Y', $fecha)->format('Y-m-d');

        //recepción de datos del formulario
        $data = [
            'nombre' => $request->input("nombre"),
            'descripcion' => $request->input("descripcion"),
            'precio' => $request->input("precio"),
            'expiracion' => $fechaFormateada,
            'stock' => $request->input("stock"),
            'idProveedor' => $request->input("idProveedor"),
        ];

        //buscamos el proveedor para verificar que exista
        $producto = ProductosModel::find($id);

        $producto->update($data);

        //redirecciona a la pagina productos, en teoria con un mensaje
        return redirect()->route('productos')->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * !Elimina un proveedor mediante su id
     */
    public function destroy(string $id)
    {

        try {
            //eliminamos el producto de la base de datos, usando su id
            ProductosModel::destroy($id);

            //redirecciona a la pagina productos, en teoria con un mensaje
            return redirect()->route('productos')->with('success', 'Producto eliminado exitosamente');
        } catch (\Exception $e) {
            //redirecciona a la pagina productos
            return redirect()->route('productos');
        }
    }
}
