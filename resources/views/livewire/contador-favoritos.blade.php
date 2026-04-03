<div>
    <h3>Mis Favoritos: {{ $total }}</h3>
    {{-- Botón simulado para que puedas probar la reactividad con el producto ID 1 --}}
    <button wire:click="toggleFavorito(1)">Añadir/Quitar Producto 1 a Favoritos</button>
</div>