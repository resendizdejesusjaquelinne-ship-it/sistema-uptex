@extends('layouts.app')

@section('content')
    <h1>Detalles del Usuario</h1>
    
    <ul>
        <li><strong>ID:</strong> {{ $usuario->id }}</li>
        <li><strong>Nombre:</strong> {{ $usuario->name }}</li>
        <li><strong>Correo:</strong> {{ $usuario->email }}</li>
    </ul>
    
    <a href="{{ route('usuarios.index') }}">Volver a la lista</a>
@endsection