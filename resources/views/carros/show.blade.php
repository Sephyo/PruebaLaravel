<!-- resources/views/carros/show.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Detalle del Carro
        </h1>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $carro->marca }} {{ $carro->modelo }}</h5>
                <p class="card-text"><strong>Año:</strong> {{ $carro->año }}</p>
                <p class="card-text"><strong>Color:</strong> {{ $carro->color }}</p>
                <p class="card-text"><strong>Precio:</strong> ${{ number_format($carro->precio, 2) }}</p>
                <p class="card-text"><strong>Kilometraje:</strong> {{ $carro->kilometraje }} km</p>
                <a href="{{ route('carros.edit', $carro) }}" class="btn btn-warning">Editar</a>
                <a href="{{ route('carros.index') }}" class="btn btn-secondary">Volver al listado</a>
            </div>
        </div>
    </div>
</x-app-layout>