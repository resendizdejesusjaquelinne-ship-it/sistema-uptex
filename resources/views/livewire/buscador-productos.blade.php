<div>
    <h3>Buscador en Tiempo Real</h3>
    <input wire:model.live='busqueda' type='text' placeholder='Buscar...' style="margin-bottom: 10px; padding: 5px;" />
    
    <ul>
        @foreach($productos as $p)
            <li>{{ $p->nombre }} - ${{ number_format($p->precio, 2) }}</li>
        @endforeach
    </ul>

    @if(!$productos->count() && $busqueda)
        <p style="color: red;">Sin resultados para "{{ $busqueda }}"</p>
    @endif
</div>