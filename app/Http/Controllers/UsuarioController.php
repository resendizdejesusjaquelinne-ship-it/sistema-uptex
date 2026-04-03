<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Asegúrate de que esta línea esté aquí

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        // Validación básica
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        // Guardar en la base de datos
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('12345678'), // Password por defecto
        ]);

        return redirect()->route('usuarios.index')->with('success', '¡Usuario creado correctamente!');
    }

    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->update($request->all());
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado');
    }
}