<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-2xl text-gray-900 leading-tight flex items-center gap-2">
            <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
            </svg>
            Panel de Administración
        </h1>
    </x-slot>

    <div class="flex justify-center py-10">
        <div class="bg-white shadow-2xl rounded-2xl p-8 max-w-lg w-full border border-gray-200">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 7l9-4 9 4M4 10v10a1 1 0 001 1h14a1 1 0 001-1V10"/>
                    </svg>
                    Estadísticas Generales
                </h2>
                <div class="flex flex-col gap-1 text-gray-700">
                    <div class="flex justify-between">
                        <span>Total de carros registrados:</span>
                        <span class="font-bold text-indigo-600">{{ $totalCarros }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Precio promedio:</span>
                        <span class="font-bold text-green-600">${{ number_format($precioPromedio, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Precio máximo:</span>
                        <span class="font-bold text-red-600">${{ number_format($precioMax, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Precio mínimo:</span>
                        <span class="font-bold text-blue-600">${{ number_format($precioMin, 2) }}</span>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div>
                <h2 class="text-lg font-semibold text-indigo-700 mb-2 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                    </svg>
                    Carros por marca
                </h2>
                <ul class="divide-y divide-gray-100">
                    @foreach($carrosPorMarca as $item)
                        <li class="py-2 flex justify-between items-center">
                            <span class="text-gray-800">{{ $item->marca }}</span>
                            <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm font-medium">{{ $item->total }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>