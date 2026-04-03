<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Contracts\View\View;

class ContadorFavoritos extends Component
{
    public int $total = 0;

    public function mount(): void
    {
        $this->total = auth()->user()->favoritos()->count();
    }

    public function toggleFavorito(int $productoId): void
    {
        $user = auth()->user();
        
        if ($user->favoritos()->where('producto_id', $productoId)->exists()) {
            $user->favoritos()->detach($productoId);
            $this->total--;
        } else {
            $user->favoritos()->attach($productoId);
            $this->total++;
        }
    }

    public function render(): View
    {
        return view('livewire.contador-favoritos');
    }
}