<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::all();
        return view('admin.pacientes.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pacientes.create');
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
            'ci'=> 'required|unique:pacientes',
            'nro_seguro'=> 'required|unique:pacientes',
            'fecha_nacimiento'=> 'required',
            'genero'=> 'required',
            'celular'=> 'required|max:25',
            'correo'=> 'required|max:255|unique:pacientes',
            'direccion'=> 'required|max:255',
            'grupo_sanguineo'=> 'required',
            'alergias'=> 'required',
            'contacto_emergencia'=> 'required',
        ]);

        $paciente = new Paciente();
        $paciente->nombres = $request->nombres;
        $paciente->apellidos = $request->apellidos;
        $paciente->ci = $request->ci;
        $paciente->nro_seguro = $request->nro_seguro;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->genero = $request->genero;
        $paciente->celular = $request->celular;
        $paciente->correo = $request->correo;
        $paciente->direccion = $request->direccion;
        $paciente->grupo_sanguineo = $request->grupo_sanguineo;
        $paciente->alergias = $request->alergias;
        $paciente->contacto_emergencia = $request->contacto_emergencia;
        $paciente->observaciones = $request->observaciones;
        $paciente->save();
        
        return redirect()->route('admin.pacientes.index')
            ->with('mensaje', 'Paciente registrado correctamente!')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('admin.pacientes.show', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $paciente = Paciente::findOrFail($id);
        return view('admin.pacientes.edit', compact('paciente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $paciente = Paciente::find($id);

        $request->validate([
            'nombres'=> 'required',
            'apellidos'=> 'required',
            'ci'=> 'required|unique:pacientes,ci,'.$paciente->id,
            'nro_seguro'=> 'required|unique:pacientes,nro_seguro,'.$paciente->id,
            'fecha_nacimiento'=> 'required',
            'genero'=> 'required',
            'celular'=> 'required|max:25',
            'correo'=> 'required|max:255|unique:pacientes,correo,'.$paciente->id,
            'direccion'=> 'required|max:255',
            'grupo_sanguineo'=> 'required',
            'alergias'=> 'required',
            'contacto_emergencia'=> 'required',
        ]);

        $paciente->nombres = $request->nombres;
        $paciente->apellidos = $request->apellidos;
        $paciente->ci = $request->ci;
        $paciente->nro_seguro = $request->nro_seguro;
        $paciente->fecha_nacimiento = $request->fecha_nacimiento;
        $paciente->genero = $request->genero;
        $paciente->celular = $request->celular;
        $paciente->correo = $request->correo;
        $paciente->direccion = $request->direccion;
        $paciente->grupo_sanguineo = $request->grupo_sanguineo;
        $paciente->alergias = $request->alergias;
        $paciente->contacto_emergencia = $request->contacto_emergencia;
        $paciente->observaciones = $request->observaciones;
        $paciente->save();
        
        return redirect()->route('admin.pacientes.index')
            ->with('mensaje', 'Paciente actualizado correctamente!')
            ->with('icono', 'success');

    }

    /**
     * Remove the specified resource from storage.
     */

     public function confirmDelete($id){
        $paciente = Paciente::findOrFail($id);
        return view('admin.pacientes.delete', compact('paciente'));
     }

    public function destroy($id)
    {
        Paciente::destroy($id);
        return redirect()->route('admin.pacientes.index')
            ->with('mensaje', 'Paciente eliminado correctamente!')
            ->with('icono', 'success');
    }
}
