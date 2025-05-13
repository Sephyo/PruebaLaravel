<!-- resources/views/carros/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Mis Carros
        </h1>
    </x-slot>

    <div class="container mx-auto px-4 py-6" x-data="{ imagenModal: null }">
        <a href="{{ route('carros.create') }}" class="btn btn-primary mb-3">Agregar Carro</a>

        @if(session('success'))
            <div class="alert alert-success mb-4">{{ session('success') }}</div>
        @endif

        {{-- Buscador y selector de cantidad --}}
        <form method="GET" action="{{ route('carros.index') }}" class="mb-4 flex flex-wrap gap-2 items-center">
            <input
                type="text"
                name="search"
                value="{{ $search ?? '' }}"
                class="form-input border rounded px-3 py-2"
                placeholder="Buscar..."
            >
            <select name="per_page" class="form-select border rounded px-3 py-2" onchange="this.form.submit()">
                @foreach([5, 10, 25, 50, 100] as $size)
                    <option value="{{ $size }}" {{ ($perPage ?? 10) == $size ? 'selected' : '' }}>{{ $size }} por página</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        {{-- Función para los links de ordenamiento --}}
        @php
            function sort_link($column, $label, $sort, $direction, $request) {
                $dir = ($sort === $column && $direction === 'asc') ? 'desc' : 'asc';
                $params = array_merge($request->all(), ['sort' => $column, 'direction' => $dir]);
                $url = route('carros.index', $params);
                $arrow = '';
                if ($sort === $column) {
                    $arrow = $direction === 'asc' ? ' ▲' : ' ▼';
                }
                return '<a href="'.$url.'" class="hover:underline">'.$label.$arrow.'</a>';
            }
        @endphp

        <div class="overflow-x-auto">
            <table class="table table-bordered min-w-full bg-white">
                <thead>
                    <tr>
                        <th>{!! sort_link('marca', 'Marca', $sort ?? 'id', $direction ?? 'desc', request()) !!}</th>
                        <th>{!! sort_link('modelo', 'Modelo', $sort ?? 'id', $direction ?? 'desc', request()) !!}</th>
                        <th>{!! sort_link('año', 'Año', $sort ?? 'id', $direction ?? 'desc', request()) !!}</th>
                        <th>{!! sort_link('color', 'Color', $sort ?? 'id', $direction ?? 'desc', request()) !!}</th>
                        <th>{!! sort_link('precio', 'Precio', $sort ?? 'id', $direction ?? 'desc', request()) !!}</th>
                        <th>{!! sort_link('kilometraje', 'Kilometraje', $sort ?? 'id', $direction ?? 'desc', request()) !!}</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($carros as $carro)
                        <tr>
                            <td>{{ $carro->marca }}</td>
                            <td>{{ $carro->modelo }}</td>
                            <td>{{ $carro->año }}</td>
                            <td>{{ $carro->color }}</td>
                            <td>${{ number_format($carro->precio, 2) }}</td>
                            <td>{{ $carro->kilometraje }} km</td>
                            <td>
                                @if($carro->imagen)
                                    <button
                                        class="btn btn-info btn-sm"
                                        @click="imagenModal = '{{ $carro->imagen }}'"
                                        type="button"
                                    >
                                        Ver imagen
                                    </button>
                                @else
                                    <span class="text-gray-400">Sin imagen</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('carros.edit', $carro) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('carros.destroy', $carro) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Seguro que deseas eliminar este carro?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No hay carros registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}
        <div class="mt-4">
            {{ $carros->links() }}
        </div>

        <!-- Modal para mostrar la imagen -->
        <div
            x-show="imagenModal"
            style="display: none;"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-60 z-50"
        >
            <div class="bg-white rounded-lg shadow-lg p-4 max-w-lg w-full relative">
                <button
                    class="absolute top-2 right-2 text-gray-600 hover:text-red-500 text-2xl"
                    @click="imagenModal = null"
                >&times;</button>
                <img :src="imagenModal" alt="Imagen del carro" class="w-full h-auto rounded" />
            </div>
        </div>
    </div>
</x-app-layout>