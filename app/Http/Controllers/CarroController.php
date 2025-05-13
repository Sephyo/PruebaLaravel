<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        $sort = $request->input('sort', 'id'); // Columna a ordenar
        $direction = $request->input('direction', 'desc'); // Dirección

        $query = Carro::query();

        if (auth()->user()->name !== 'Admin') {
            $query->where('user_id', auth()->id());
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('marca', 'like', "%$search%")
                    ->orWhere('modelo', 'like', "%$search%")
                    ->orWhere('color', 'like', "%$search%")
                    ->orWhere('año', 'like', "%$search%");
            });
        }

        // Validar columnas permitidas para ordenar
        $sortable = ['marca', 'modelo', 'año', 'color', 'precio', 'kilometraje', 'id'];
        if (!in_array($sort, $sortable)) {
            $sort = 'id';
        }
        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }

        $carros = $query->orderBy($sort, $direction)
            ->paginate($perPage)
            ->appends($request->all());

        return view('carros.index', [
            'carros' => $carros,
            'perPage' => $perPage,
            'search' => $search,
            'sort' => $sort,
            'direction' => $direction,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('carros.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'año' => 'required|integer|min:1900|max:' . date('Y'),
            'color' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'kilometraje' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['marca', 'modelo', 'año', 'color', 'precio', 'kilometraje']);
        $data['user_id'] = auth()->id();

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('carros', 'public');
            $data['imagen'] = '/storage/' . $path;
        }

        Carro::create($data);

        return redirect()->route('carros.index')->with('success', 'Carro registrado correctamente');
    }
    /**
     * Display the specified resource.
     */
    public function show(Carro $carro)
    {
        $this->authorizeCarro($carro, 'view');
        return view('carros.show', compact('carro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carro $carro)
    {
        $this->authorizeCarro($carro, 'edit');
        return view('carros.edit', compact('carro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carro $carro)
    {
        $this->authorizeCarro($carro, 'edit');

        $request->validate([
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'año' => 'required|integer|min:1900|max:' . date('Y'),
            'color' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'kilometraje' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only(['marca', 'modelo', 'año', 'color', 'precio', 'kilometraje']);

        if ($request->hasFile('imagen')) {
            // Elimina la imagen anterior si existe
            if ($carro->imagen) {
                $imagenPath = str_replace('/storage/', '', $carro->imagen);
                Storage::disk('public')->delete($imagenPath);
            }
            $path = $request->file('imagen')->store('carros', 'public');
            $data['imagen'] = '/storage/' . $path; // Guarda la URL pública
        }

        $carro->update($data);

        return redirect()->route('carros.index')->with('success', 'Carro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carro $carro)
    {
        $this->authorizeCarro($carro, 'delete');

        $carro->delete();

        return redirect()->route('carros.index')->with('success', 'Carro eliminado correctamente');
    }

    /**
     * Autoriza acciones sobre el carro según el usuario y la acción.
     */
    protected function authorizeCarro(Carro $carro, $action = 'view')
    {
        // Admin puede hacer cualquier acción sobre cualquier carro
        if (auth()->user()->name === 'Admin') {
            return true;
        }

        // Usuarios normales: solo pueden ver, editar o eliminar sus propios carros
        if ($carro->user_id !== auth()->id()) {
            abort(403, 'No tienes permiso para acceder a este carro.');
        }
    }
}
