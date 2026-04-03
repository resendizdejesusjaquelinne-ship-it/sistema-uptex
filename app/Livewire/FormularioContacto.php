<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Contracts\View\View;

class FormularioContacto extends Component
{
    public string $nombre = '';
    public string $email = '';
    public string $mensaje = '';
    public bool $enviado = false;

    protected array $rules = [
        'nombre' => 'required|min:3',
        'email' => 'required|email',
        'mensaje' => 'required|min:10',
    ];

    public function updated($field): void
    {
        $this->validateOnly($field);
    }

    public function enviar(): void
    {
        $this->validate();
        
        // Aquí iría el código de Mail::to('admin@uptex.edu.mx')->send(...);
        
        $this->reset(['nombre', 'email', 'mensaje']);
        $this->enviado = true;
    }

    public function render(): View
    {
        return view('livewire.formulario-contacto');
    }
}