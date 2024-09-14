<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use App\Models\Doctor;
use App\Models\Horario;
use Exception;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultorios = Consultorio::all();
        $horarios = Horario::with('doctor', 'consultorio')->get();
        return view('admin.horarios.index', compact('horarios', 'consultorios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $doctores = Doctor::all();
        $consultorios = Consultorio::all();
        $horarios = Horario::with('doctor', 'consultorio')->get();
        return view('admin.horarios.create', compact('doctores', 'consultorios', 'horarios'));
    }

    public function cargarDatosConsultorios($id){
        try{
            // Horarios con relacion en tabla doctores y consultorio, donde el consultorio_id = $id (el que recibimos por parametro)
            $horarios = Horario::with('doctor', 'consultorio')->where('consultorio_id',$id)->get(); 
            //print_r($horarios);
            return view('admin.horarios.cargarDatosConsultorios', compact('horarios'));
        }catch(Exception $e){
            return response()->json(['mensaje'=> 'Error']);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = $request->all();
        //return response()->json($datos);

        $request->validate([
            'dia'=> 'required',
            'hora_inicio'=> 'required|date_format:H:i',
            'hora_fin'=> 'required|date_format:H:i|after:hora_inicio',
            'consultorio_id'=> 'required|exists:consultorios,id', // Verificar que el consultorio exista
        ]);

        // Verificar si el horario ya existe para ese dia, intervalo de tiempo y consultorio
        $horarioExistente = Horario::where('dia', $request->dia)
        ->where(function ($query) use ($request) {
            // Filtrar por consultorio o por doctor
            $query->where('consultorio_id', $request->consultorio_id)
                ->orWhere('doctor_id', $request->doctor_id); // Asegurarse de que el doctor no esté en otro consultorio al mismo tiempo
        })
        ->where(function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->where('hora_inicio', '>=', $request->hora_inicio)
                    ->where('hora_inicio', '<', $request->hora_fin);
            })
            ->orWhere(function ($query) use ($request) {
                $query->where('hora_fin', '>', $request->hora_inicio)
                    ->where('hora_fin', '<=', $request->hora_fin);
            })
            ->orwhere(function ($query) use ($request) {
                $query->where('hora_inicio', '<', $request->hora_inicio)
                    ->where('hora_fin', '>', $request->hora_fin);
            });
        })
        ->exists();

        if ($horarioExistente) {
            return redirect()->back()
                ->withInput()
                ->with('mensaje', 'Ya existe un horario que se superpone con el horario ingresado!')
                ->with('icono', 'error');
        }


        // Forma rapida de crear un Horario
        Horario::create($request->all());

        return redirect()->route('admin.horarios.index')
            ->with('mensaje', 'Horario registrado correctamente!')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //$horario = Horario::findOrFail($id)->with('doctor', 'consultorio');
        $horario = Horario::with('doctor', 'consultorio')->findOrFail($id);
        return view('admin.horarios.show', compact('horario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Horario $horario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Horario $horario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Horario $horario)
    {
        //
    }
}
