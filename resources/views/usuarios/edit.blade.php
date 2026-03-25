@extends('layouts.app')

@section('content')
    <h1>Editar Usuario</h1>
    
    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ $usuario->name }}" required>
        </div>
        <br>
        <div>
            <label for="email">Correo Electrónico:</label>
            <input type="email" name="email" id="email" value="{{ $usuario->email }}" required>
        </div>
        <br>
        <button type="submit">Actualizar Usuario</button>
        <a href="{{ route('usuarios.index') }}">Cancelar</a>
    </form>
@endsection