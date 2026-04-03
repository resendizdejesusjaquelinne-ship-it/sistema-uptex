{{-- resources/views/carrito/index.blade.php --}}

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carrito - PharmaSys</title>
</head>
<body>
    <h2>Mi Carrito de Compras</h2>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @php 
        $total = array_sum(array_map(fn($i) => $i['precio'] * $i['cantidad'], $carrito)); 
    @endphp

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cant.</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($carrito as $id => $item)
            <tr>
                <td>{{ $item['nombre'] }}</td>
                <td>${{ number_format($item['precio'], 2) }}</td>
                <td>
                    <form method="POST" action="{{ route('carrito.actualizar', $id) }}">
                        @csrf 
                        @method('PATCH')
                        <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1">
                        <button type="submit">Actualizar</button>
                    </form>
                </td>
                <td>${{ number_format($item['precio'] * $item['cantidad'], 2) }}</td>
                <td>
                    <form method="POST" action="{{ route('carrito.eliminar', $id) }}">
                        @csrf 
                        @method('DELETE') 
                        <button type="submit">Quitar</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">El carrito está vacío.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <br>
    <strong>Total: ${{ number_format($total, 2) }}</strong>
    <br><br>

    {{-- Botón para vaciar todo el carrito (Solo aparece si hay productos) --}}
    @if(count($carrito) > 0)
        <form method="POST" action="{{ route('carrito.vaciar') }}">
            @csrf 
            @method('DELETE')
            <button type="submit" style="color: red;">Vaciar Carrito</button>
        </form>
    @endif

    <br>
    <a href="{{ route('productos.index') }}">Volver a Productos</a>
</body>
</html>