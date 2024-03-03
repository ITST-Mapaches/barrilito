<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{-- !titulo de la sección --}}
            {{ __('Proveedores') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- !contenido de la sección --}}

            <a href="{{ route('agregarproveedor') }}"
                class="block w-min mx-auto cursor-pointer text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text- mb-2 active:scale-90">Agregar</a>

            <br>

            {{-- * agrega la paginación --}}
            {{ $proveedores->links() }}
            <br>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                {{-- * tabla --}}

                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead
                            class="text-xs text-center text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Razón social
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Dirección
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Telefono
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Correo
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    RFC
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- * recorremos el arreglo de proveedores y mostramos la propiedad que necesitamos, exactamente igual que en la base de datos --}}
                            @foreach ($proveedores as $proveedor)
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $proveedor->idProveedor }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $proveedor->razonSocial }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $proveedor->nombreCompleto }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $proveedor->direccion }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $proveedor->telefono }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $proveedor->correo }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $proveedor->rfc }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('editarproveedor', $proveedor->idProveedor) }}"
                                            class="block mx-auto active:scale-90 text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">Editar</a>
                                        <a href="{{ route('eliminarproveedor', $proveedor->idProveedor) }}"
                                            class="block mx-auto active:scale-90 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">Eliminar</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- * fin de tabla --}}

            </div>

            <br>
            {{-- *agrega la paginación --}}
            {{ $proveedores->links() }}

            {{-- !fin contenido de la sección --}}

        </div>
    </div>

</x-app-layout>
