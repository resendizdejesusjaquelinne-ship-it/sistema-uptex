<?php

namespace App\Jobs;

use App\Models\Producto;
use App\Models\User;
use App\Mail\ReporteListo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class GenerarReporteCsv implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3; // Reintentos si falla
    public int $timeout = 120; // Segundos máximos

    public function __construct(
        public User $usuario,
        public string $filtro = ''
    ) {}

    public function handle(): void
    {
        $query = Producto::with('categoria');
        
        if ($this->filtro) {
            $query->where('nombre', 'LIKE', '%' . $this->filtro . '%');
        }
        
        $productos = $query->get();
        
        // Generar CSV en memoria
        $csv = "ID,Nombre,Categoria,Precio,Stock\n";
        
        foreach ($productos as $p) {
            $categoria = $p->categoria->nombre ?? '';
            $csv .= implode(',', [
                $p->id, 
                $p->nombre,
                $categoria, 
                $p->precio, 
                $p->stock
            ]) . "\n";
        }
        
        // Guardar y enviar por correo
        $ruta = 'reportes/productos-' . now()->format('Ymd-His') . '.csv';
        Storage::disk('public')->put($ruta, $csv);
        
        Mail::to($this->usuario)->send(new ReporteListo($ruta));
    }
}