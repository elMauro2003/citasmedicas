<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use App\Models\Consultorio;
use App\Models\Doctor;
use App\Models\Event;
use App\Models\Paciente;
use App\Models\Horario;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Secretaria;

class AdminController extends Controller
{
    public function index(){

        // Contadores
        $totalUsuarios = User::count();
        $totalSecretarias = Secretaria::count();
        $totalPacientes = Paciente::count();
        $totalConsultorios = Consultorio::count();
        $totalDoctores = Doctor::count();
        $totalHorarios = Horario::count();
        $totalReservas = Event::count();
        $totalConfiguraciones = Configuracion::count();

        // Instancias de Modelos
        $consultorios = Consultorio::all();
        $doctores = Doctor::all();
        $eventos = Event::all();

        return view('admin.index', compact('totalUsuarios', 'totalSecretarias', 'totalPacientes', 'totalConsultorios', 'totalDoctores', 'totalHorarios', 'consultorios', 'doctores', 'eventos', 'totalReservas', 'totalConfiguraciones'));
    }

    public function verReservas($id){
        $eventos = Event::where('user_id', $id)->get();
        return view('admin.verReservas', compact('eventos'));
    }
}
