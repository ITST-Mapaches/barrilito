<?php

namespace App\Http\Controllers;

use App\Models\ClientesModel;
use App\Models\ProductosModel;
use Illuminate\Http\Request;

class ClientesController extends Controller
{
    /**
     * !Muestra el módulo clientes, una tabla con los clientes
     */
    public function index(Request $request)
    {
        //guardamos el valor de la petición search en $search
        $search = $request->search;

        //buscamos los registros cuyo nombre o razon social que contenga el valor de la busqueda al inicio / medio o final
        // ademas los ordena de manera ascendente por su id y los pagina de 15 en 15
        $clientes = ClientesModel::select('clientes.*', 'productos.nombre as nombre_producto')
            ->leftJoin('productos', 'clientes.idProducto', '=', 'productos.idProducto')
            ->where("clientes.nombre", "LIKE", "%" . $search . "%")
            ->orWhere("clientes.apellidoPaterno", "LIKE", "%" . $search . "%")
            ->orWhere("clientes.apellidoMaterno", "LIKE", "%" . $search . "%")
            ->orderBy("clientes.idCliente", "asc")
            ->paginate(15);

        // evalua si se debe reestablecer la busqueda, si $search es vacio significa que no se ha hecho ninguna búsqueda
        $reestablecerBusqueda = ($search == "") ? false : true;

        //en el arreglo agregamos pares: clave - valor
        $data = [
            'search' => $search,
            'clientes' => $clientes,
            'reestablecerBusqueda' => $reestablecerBusqueda
        ];

        //mostramos la vista y le enviamos los registros de proveedores
        return view("clientes/index", $data);
    }

    /**
     * !Muestra la vista con el formulario para agregar un cliente
     */
    public function create()
    {
        //hacemos una busqueda de productos
        $productos = ProductosModel::get(['idProducto', 'nombre']);

        //retornamos la vista que contiene el formulario para agregar clientes y enviamos productos
        return view("clientes/agregar/agregar", compact("productos"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function insert(Request $request)
    {
        //recepción de datos del formulario
        $data = [
            'nombre' => $request->input("nombre"),
            'apellidoPaterno' => $request->input("apePaterno"),
            'apellidoMaterno' => $request->input("apeMaterno"),
            'rfc' => $request->input("rfc"),
            'telefono' => $request->input("telefono"),
            'correo' => $request->input("correo"),
            'direccion' => $request->input("direccion"),
            'idProducto' => $request->input("idProducto"),
        ];

        // Insersión del nuevo regristro en la base de datos
        ClientesModel::create($data);

        //redirigimos a la vista clientes, en teoría con un mensaje
        return redirect()->route('clientes')->with('success', 'Cliente agregado exitosamente!');
    }


    /**
     * !Edita un cliente, este es el previo antes de actualizar definitivamente
     */
    public function edit(string $id)
    {
        //buscamos la información del producto por su id
        $cliente = ClientesModel::find($id);

        //hacemos una busqqueda de productos
        $productos = ProductosModel::get(['idProducto', 'nombre']);

        $data = [
            'cliente' => $cliente,
            'productos' => $productos
        ];

        //retornamos la vista que contiene el formulario para agregar clientes y enviamos productos
        return view("clientes/editar/editar", $data);
    }

    /**
     * !Actualiza un cliente en específico
     */
    public function update(Request $request, string $id)
    {
        //recepción de datos del formulario
        $data = [
            'nombre' => $request->input("nombre"),
            'apellidoPaterno' => $request->input("apePaterno"),
            'apellidoMaterno' => $request->input("apeMaterno"),
            'rfc' => $request->input("rfc"),
            'telefono' => $request->input("telefono"),
            'correo' => $request->input("correo"),
            'direccion' => $request->input("direccion"),
            'idProducto' => $request->input("idProducto"),
        ];

        $cliente = ClientesModel::find($id);

        // Insersión del nuevo regristro en la base de datos
        $cliente->update($data);

        //redirigimos a la vista clientes, en teoría con un mensaje
        return redirect()->route('clientes')->with('success', 'Cliente actualizado exitosamente!');
    }

    /**
     * !Elimina un cliente mediante su id
     */
    public function destroy(string $id)
    {
        //eliminamos el cliente de la base de datos, usando su id
        ClientesModel::destroy($id);

        //redirigimos a la vista clientes, en teoría con un mensaje
        return redirect()->route('clientes')->with('success', 'Cliente eliminado exitosamente!');
    }
}
