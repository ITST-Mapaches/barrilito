<?php

namespace App\Http\Controllers;

use App\Models\ProveedoresModel;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
{
    /**
     * !Muestra el módulo provedores, una tabla con los proveddores
     */
    public function index()
    {
        //obtenemos la lista de los proveedores ordenados por id y con paginacion de 15 en 15
        $proveedores = ProveedoresModel::orderBy("idProveedor", "asc")->paginate(15);

        //mostramos la vista y le enviamos los registros de proveedores
        return view("proveedores/index", compact("proveedores"));
    }

    /**
     * !Muestra la vista con el formulario para agregar un proveedor
     */
    public function create()
    {
        return view("proveedores/agregar/agregar");
    }

    /**
     * !Inserta un registro en la base de datos
     */
    public function insert(Request $request)
    {
        //recepción de datos del formulario
        $data = [
            'razonSocial' => $request->input("razon_social"),
            'nombreCompleto' => $request->input("nombre"),
            'direccion' => $request->input("direccion"),
            'telefono' => $request->input("telefono"),
            'correo' => $request->input("correo"),
            'rfc' => $request->input("rfc")
        ];

        // Insersión del nuevo regristro en la base de datos
        ProveedoresModel::create($data);

        //redirecciona a la pagina proveedores
        return redirect()->route('proveedores');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * !Edita un proveedor, este es el previo antes de actualizar definitivamente
     */
    public function edit(string $id)
    {
        //busca el proveedor
        $proveedor = ProveedoresModel::find($id);

        //retorna la vista para actualizar y envia resultado de la busqueda
        return view('proveedores/editar/editar', compact('proveedor'));
    }

    /**
     * !Actualiza un proveedor en específico
     */
    public function update(Request $request, string $id)
    {
        //recepción de datos del formulario
        $data = [
            'razonSocial' => $request->input("razon_social"),
            'nombreCompleto' => $request->input("nombre"),
            'direccion' => $request->input("direccion"),
            'telefono' => $request->input("telefono"),
            'correo' => $request->input("correo"),
            'rfc' => $request->input("rfc")
        ];

        //buscamos el proveedor para verificar que exista
        $proveedor = ProveedoresModel::find($id);

        //actualizamos ese proveedor con los datos recibidos
        $proveedor->update($data);

        //redirigimos a la vista proveedores, en teoría con un mensaje
        return redirect()->route('proveedores')->with('success', 'Proveedor eliminado exitosamente!');
    }

    /**
     * !Elimina un proveedor mediante su id
     */
    public function destroy(string $id)
    {
        //eliminamos el proveedor de la base de datos, usando su id
        ProveedoresModel::destroy($id);

        //redirigimos a la vista proveedores, en teoría con un mensaje
        return redirect()->route('proveedores')->with('success', 'Proveedor eliminado exitosamente!');
    }
}
