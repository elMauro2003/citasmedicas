<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index(){
        $usuarios = User::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create(){
        return view('admin.usuarios.create');
    }

    public function store(Request $request){

        // Validamos los datos del Formulario
        $request->validate([
            'name'=>'required|max:250',
            'email'=>'required|max:250|unique:users',
            'password'=>'required|max:250|confirmed',
        ]);
        
        // Guardamos los datos ya validados en la BD
        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();

        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario registrado correctamente!')
            ->with('icono', 'success');

        // Con esto capturamos todos los capos de la variable $datos y los mostramos en un json
        //$datos = request()->all();
        //return response()->json($datos);
    }

    public function show($id){
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    public function edit($id){
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id){
        $usuario = User::find($id);
        $request->validate([
            'name'=>'required|max:250',
            'email'=>'required|max:250|unique:users,email,'.$usuario->id,
            'password'=>'nullable|max:250|confirmed',
        ]);
        $usuario->name = $request->name;
        $usuario->email = $request->email;

        if ($request->filled('password')){
            $usuario->password = Hash::make($request['password']);
        }
        $usuario->save();
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario actualizado correctamente!')
            ->with('icono', 'success');
    }

    public function confirmDelete($id){
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.delete', compact('usuario'));
    }

    public function destroy($id){
        User::destroy($id);
        return redirect()->route('admin.usuarios.index')
            ->with('mensaje', 'Usuario eliminado correctamente!')
            ->with('icono', 'success');
    }


}
