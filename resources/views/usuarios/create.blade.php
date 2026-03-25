@extends('layouts.app')

@section('content')
    <h1>Crear Nuevo Usuario</h1>
    
    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" required>
        </div>
        <br>
        <div>
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <br>
        <button type="submit">Guardar Usuario</button>
        <a href="{{ route('usuarios.index') }}">Cancelar</a>
    </form>
@endsection