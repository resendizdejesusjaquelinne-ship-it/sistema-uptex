<div style="padding: 20px;">
    <table border="1" cellpadding="10" style="width: 100%; text-align: left;">
        <thead>
            <tr>
                <th>Nombre del Medicamento</th>
                <th>Precio</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            {{-- Recorremos los productos de la base de datos --}}
            @forelse($productos as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>${{ number_format($producto->precio, 2) }}</td>
                    <td>
                        {{-- Botón que manda al carrito --}}
                        <form action="{{ route('carrito.agregar', $producto->id) }}" method="POST">
                            @csrf
                            <button type="submit" style="background-color: #4CAF50; color: white; padding: 5px 10px; border: none; cursor: pointer;">
                                Agregar al Carrito
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Aún no hay productos registrados en la base de datos.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>