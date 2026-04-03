<?php

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ProductoController;
use App\Models\Producto;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Route;

// Ruta de bienvenida
Route::get('/', function () {
    return view('welcome');
});

// Dashboard protegido
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// --- TODAS LAS RUTAS PROTEGIDAS POR AUTH ---
Route::middleware('auth')->group(function () {
    
    // 1. Recursos principales (Usuarios y Productos)
    // Esto crea: productos.index, productos.store, productos.create, etc.
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('productos', ProductoController::class); 

    // 2. Rutas del Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 3. Historial de Actividad (Evidencia)
    Route::get('/actividad', function() {
        $logs = ActivityLog::with('user')->latest()->take(50)->get();
        return view('actividad.index', compact('logs'));
    })->name('actividad.index');

    // 4. Reportes
    Route::post('/reportes/csv', [ProductoController::class, 'exportarCsv'])->name('reportes.csv');
});

// --- RUTAS DE PRUEBA / TRAMPA (PARA EVIDENCIA) ---
Route::middleware('auth')->group(function () {
    Route::get('/crear-producto-prueba', [ProductoController::class, 'store']);
    Route::get('/actualizar-producto-prueba', function() {
        $producto = Producto::first();
        if (!$producto) return "No hay productos para actualizar. Crea uno primero.";
        $controller = new ProductoController();
        return $controller->update(request(), $producto);
    });
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/{producto}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::patch('/carrito/{id}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
    Route::delete('/carrito/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::delete('/carrito', [CarritoController::class, 'vaciar'])->name('carrito.vaciar');
});