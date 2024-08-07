<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicios;
use App\Models\Producto;

class ConsultasMEDICOController extends Controller
{
    public function index(Request $request)
    {
        $servicios = Servicios::all(); // Obtener todos los servicios
        $productos = Producto::all(); // Obtener todos los medicamentos
        $paciente = $request->input('paciente'); // Obtener el nombre del paciente desde el parámetro de la URL

        return view('medico.consultas', compact('servicios', 'productos', 'paciente'));
    }
}
