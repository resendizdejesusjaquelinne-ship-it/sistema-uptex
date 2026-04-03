<?php
namespace App\Events;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ProductoGuardado
{
    use Dispatchable, SerializesModels; // [cite: 178]

    // Promoción de propiedades de PHP 8 (como lo pide tu PDF)
    public function __construct(
        public Producto $producto, // [cite: 181]
        public string $accion, // [cite: 182]
        public ?User $usuario = null // [cite: 183, 186]
    ) {}
}