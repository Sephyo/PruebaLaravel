<?php

namespace App\Http\Controllers;

use App\Models\Carro;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function panel()
    {
        $totalCarros = Carro::count();
        $carrosPorMarca = Carro::select('marca', \DB::raw('count(*) as total'))->groupBy('marca')->get();
        $precioPromedio = Carro::avg('precio');
        $precioMax = Carro::max('precio');
        $precioMin = Carro::min('precio');

        return view('admin.panel', compact('totalCarros', 'carrosPorMarca', 'precioPromedio', 'precioMax', 'precioMin'));
    }
}
