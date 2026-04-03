<?php
namespace App\Listeners;

use App\Events\ProductoGuardado;
use App\Models\ActivityLog;

class RegistrarActividad
{
    public function handle(ProductoGuardado $event): void // [cite: 198]
    {
        ActivityLog::create([ // 
            'accion'      => $event->accion, // [cite: 200]
            'modelo'      => 'Producto', // [cite: 204]
            'modelo_id'   => $event->producto->id, // [cite: 205]
            'descripcion' => 'Producto ' . $event->accion . ': ' . $event->producto->nombre, // [cite: 206, 207]
            'user_id'     => $event->usuario?->id ?? auth()->id(), // [cite: 212]
        ]);
    }
}
