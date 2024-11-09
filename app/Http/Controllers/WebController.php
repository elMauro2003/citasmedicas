<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Horario;
use App\Models\User;
use Exception;

class WebController extends Controller
{
    public function index(){
        $consultorios = Consultorio::all();
        return view('index', compact('consultorios'));
    }

    // Prueba
    public function prueba($id){
        //$consultorios = Consultorio::all();
        $usuario = User::findOrFail($id);
        return view('admin.prueba', compact('usuario'));
    }

    public function cargarDatosConsultorios($id){
        $consultorio = Consultorio::find($id);
        try{
            // Horarios con relacion en tabla doctores y consultorio, donde el consultorio_id = $id (el que recibimos por parametro)
            $horarios = Horario::with('doctor', 'consultorio')->where('consultorio_id',$id)->get(); 
            return view('cargarDatosConsultorios', compact('horarios', 'consultorio'));
        }catch(Exception $e){
            return response()->json(['mensaje'=> 'Error']);
        }
    }

    public function cargarReservaDoctores($id){
        try{
            // Horarios con relacion en tabla doctores y consultorio, donde el consultorio_id = $id (el que recibimos por parametro)
            $eventos = Event::where('doctor_id',$id)
            ->select('id', 'title', 
            DB::raw('DATE_FORMAT(start, "%Y-%m-%d") as start'), 
            DB::raw('DATE_FORMAT(end, "%Y-%m-%d") as end') )
            ->get(); 
            return response()->json($eventos);
        }catch(Exception $e){
            return response()->json(['mensaje'=> 'Error']);
        }
    }

}
