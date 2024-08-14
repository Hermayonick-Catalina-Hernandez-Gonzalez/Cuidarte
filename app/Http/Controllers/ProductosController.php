<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductosController extends Controller
{
    public function index()
    {
        $productos = Producto::paginate(100);
        return view('secretario.medicamentos', compact('productos'));
    }

    public function storeVenta(Request $request)
    {


        $updatedProducts = [];
        foreach ($request->medicacion as $index => $producto_id) {
            $cantidad = $request->cantidad[$index];
            $producto = Producto::find($producto_id);

            if ($producto && $producto->cantidad >= $cantidad) {
                $producto->cantidad -= $cantidad;

                if ($producto->cantidad <= 0) {
                    // Elimina el producto si la cantidad es cero o menor
                    $producto->delete();
                } else {
                    $producto->save();
                }

                $updatedProducts[] = $producto;
            } else {
                return response()->json(['error' => 'Cantidad insuficiente o producto no encontrado.'], 400);
            }
        }

        return response()->json([
            'success' => 'Venta realizada con éxito.',
            'updatedProducts' => $updatedProducts,
        ]);
    }
}
