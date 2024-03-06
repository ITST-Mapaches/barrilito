<x-app-layout>
    <x-slot name="header">

        <div class="w-full flex justify-between flex-wrap gap-2">

            <h2 class=" inline font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{-- !titulo de la sección --}}
                {{ __('Clientes') }}
            </h2>

            {{-- * barra de busqueda --}}
            <form class="flex items-center min-w-96" action="{{ route('clientes') }}" method="GET">
                <label for="search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="whitesmoke" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                    </div>
                    <input type="text" id="search" name="search"
                        title="Busca por nombre o apellido paterno / materno"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:focus:bg-gray-600"
                        placeholder="Busca un cliente..." required />
                </div>
                <button type="submit" title="Buscar"
                    class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 active:scale-90 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
                {{-- * evalua si aparece un boton para redirigirnos a la vista clientes dependiendo del valor actual de la variable --}}
                @if ($reestablecerBusqueda)
                    <a href="{{ route('clientes') }}" title="Reestablecer búsqueda"
                        class="p-2.5 ms-2 text-sm font-medium text-white bg-red-700 rounded-lg border border-red-700 hover:bg-red-800 active:scale-90 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </a>
                @endif
            </form>

        </div>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- !contenido de la sección --}}

            <a href="{{ route('agregarcliente') }}"
                class="block w-min mx-auto cursor-pointer text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text- mb-2 active:scale-90">Agregar</a>

            <br>

            {{-- * agrega la paginación --}}
            {{ $clientes->appends(['search' => $search]) }}
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
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Apellido paterno
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Apellido Materno
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    RFC
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Telefono
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Correo
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Dirección
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Producto
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- * recorremos el arreglo de clientes y mostramos la propiedad que necesitamos, exactamente igual que en la base de datos --}}
                            @foreach ($clientes as $cliente)
                                <tr
                                    class="odd:bg-white text-center odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $cliente->idCliente }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $cliente->nombre }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $cliente->apellidoPaterno }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $cliente->apellidoMaterno }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $cliente->rfc }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $cliente->telefono }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $cliente->correo }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $cliente->direccion }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('productos') }}" method="get">
                                            <input type="text" id="search" name="search"
                                                value="{{ $cliente->nombre_producto }}" class="hidden" />
                                            <button type="submit"
                                                class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-full border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">{{ $cliente->nombre_producto }}</button>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('editarcliente', $cliente->idCliente) }}"
                                            class="block w-fit mx-auto active:scale-90 text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">Editar</a>
                                        <a href="{{ route('eliminarcliente', $cliente->idCliente) }}"
                                            class="block w-fit mx-auto active:scale-90 text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">Eliminar</a>
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
            {{ $clientes->appends(['search' => $search]) }}

            {{-- !fin contenido de la sección --}}

        </div>
    </div>

</x-app-layout>
