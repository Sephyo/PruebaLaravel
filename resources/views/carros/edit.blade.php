<!-- resources/views/carros/edit.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Carro
        </h1>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <form action="{{ route('carros.update', $carro) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Marca</label>
                <input type="text" name="marca" class="form-control" value="{{ old('marca', $carro->marca) }}" required>
                @error('marca') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Modelo</label>
                <input type="text" name="modelo" class="form-control" value="{{ old('modelo', $carro->modelo) }}" required>
                @error('modelo') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Año</label>
                <input type="number" name="año" class="form-control" value="{{ old('año', $carro->año) }}" required min="1900" max="{{ date('Y') }}">
                @error('año') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Color</label>
                <input type="text" name="color" class="form-control" value="{{ old('color', $carro->color) }}" required>
                @error('color') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Precio</label>
                <input type="number" name="precio" class="form-control" value="{{ old('precio', $carro->precio) }}" required step="0.01" min="0">
                @error('precio') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label>Kilometraje</label>
                <input type="number" name="kilometraje" class="form-control" value="{{ old('kilometraje', $carro->kilometraje) }}" required min="0">
                @error('kilometraje') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
            <div class="mb-3">
                <label for="imagen">Imagen del carro</label>
                <input type="file" name="imagen" accept="image/*" class="form-control">
                @if(isset($carro) && $carro->imagen)
                    <img src="{{ asset('storage/' . $carro->imagen) }}" alt="Imagen" style="max-width: 200px;">
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ route('carros.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</x-app-layout>