<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use App\Models\Doctor;
use App\Models\Paciente;
use App\Models\Horario;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Secretaria;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /*$totalUsuarios = User::count();
        $totalSecretarias = Secretaria::count();
        $totalPacientes = Paciente::count();
        $totalConsultorios = Consultorio::count();
        $totalDoctores = Doctor::count();
        $totalHorarios = Horario::count();
        return view('admin.index', compact('totalUsuarios', 'totalSecretarias', 'totalPacientes', 'totalConsultorios', 'totalDoctores', 'totalHorarios'));*/
        return view('index');
    }
}
