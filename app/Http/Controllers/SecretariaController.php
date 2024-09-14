<?php

namespace App\Http\Controllers;
use App\Models\Secretaria;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SecretariaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $secretarias = Secretaria::with('user')->get();
        return view('admin.secretarias.index', compact('secretarias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.secretarias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = $request->all();
        //return response()->json($datos);
        $request->validate([
            'nombres'=> 'required',
            'apellidos'=> 'required',
            'ci'=> 'required|unique:secretarias',
            'celular'=> 'required|max:25',
            'direccion'=> 'required|max:255',
            'email'=> 'required|max:255|unique:users',
            'password'=> 'required|max:255|confirmed',
        ]);

        $usuario = new User();
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();

        $secretaria = new Secretaria();
        $secretaria->user_id = $usuario->id;
        $secretaria->nombres = $request->nombres;
        $secretaria->apellidos = $request->apellidos;
        $secretaria->ci = $request->ci;
        $secretaria->celular = $request->celular;
        $secretaria->fecha_nacimiento = $request->fecha_nacimiento;
        $secretaria->direccion = $request->direccion;
        $secretaria->save();

        $usuario->assignRole('secretaria');

        return redirect()->route('admin.secretarias.index')
            ->with('mensaje', 'Secretaria registrada correctamente!')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $secretaria = Secretaria::with('user')->findOrFail($id);
        return view('admin.secretarias.show', compact('secretaria'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $secretaria = Secretaria::with('user')->findOrFail($id);
        return view('admin.secretarias.edit', compact('secretaria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $secretaria = Secretaria::find($id);
        
        $request->validate([
            'nombres'=> 'required',
            'apellidos'=> 'required',
            'ci'=> 'required|unique:secretarias,ci,'.$secretaria->$id,
            'celular'=> 'required|max:25',
            'direccion'=> 'required|max:255',
            'email'=> 'required|max:255|unique:users,email,'.$secretaria->user->id,
            'password'=> 'nullable|max:255|confirmed',
        ]);

        $secretaria->nombres = $request->nombres;
        $secretaria->apellidos = $request->apellidos;
        $secretaria->ci = $request->ci;
        $secretaria->celular = $request->celular;
        $secretaria->fecha_nacimiento = $request->fecha_nacimiento;
        $secretaria->direccion = $request->direccion;
        $secretaria->save();

        $usuario = User::find($secretaria->user->id);
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        if ($request->filled('password')){
            $usuario->password = Hash::make($request['password']);
        }
        $usuario->save();
        return redirect()->route('admin.secretarias.index')
            ->with('mensaje', 'Secretaria actualizada correctamente!')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */

     public function confirmDelete($id){
        $secretaria = Secretaria::with('user')->findOrFail($id);
        return view('admin.secretarias.delete', compact('secretaria'));
     }

    public function destroy($id)
    {
        $secretaria = Secretaria::find($id);

        // Eliminar al usuario asociado
        $user = $secretaria->user;
        $user->delete();
        // Eliminar a la secretaria
        $secretaria->delete();  

        return redirect()->route('admin.secretarias.index')
            ->with('mensaje', 'Secretaria eliminada correctamente!')
            ->with('icono', 'success');
    }
}
