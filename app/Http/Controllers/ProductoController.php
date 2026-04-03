<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProductoController extends Controller
{
    // Muestra la lista de productos
    public function index()
    {
        $productos = Producto::all();
        // Asegúrate de que la carpeta sea 'productos' y el archivo 'index.blade.php'
        return view('productos.index', compact('productos'));
    }

    // Guarda el producto
public function store(Request $request)
{
    // Verificamos permisos primero para que el test de 403 pase rápido
    if (auth()->user()->rol !== 'admin') {
        abort(403);
    }

    $validated = $request->validate([
        'nombre'       => 'required|unique:productos,nombre',
        'precio'       => 'required|numeric',
        'stock'        => 'required|integer',
        'categoria_id' => 'required|exists:categorias,id',
        'descripcion'  => 'nullable|string',
    ]);

    // Quitamos el all(), pasamos directamente $validated
    Producto::create($validated);

    return redirect()->route('productos.index');
}
}