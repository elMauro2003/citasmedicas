<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PhpParser\Comment\Doc;
use Symfony\Component\VarDumper\Caster\DoctrineCaster;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Traer los doctores con sus credenciales de usuario
        $doctores = Doctor::with('user')->get();
        return view('admin.doctores.index', compact('doctores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.doctores.create');
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
            'telefono'=> 'required',
            'licencia_medica'=> 'required',
            'especialidad'=> 'required',
            'email'=> 'required|max:255|unique:users',
            'password'=> 'required|confirmed',
        ]);

        $usuario = new User();
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();

        $doctor = new Doctor();
        $doctor->user_id = $usuario->id;
        $doctor->nombres = $usuario->name;
        $doctor->apellidos = $request->apellidos;
        $doctor->telefono = $request->telefono;
        $doctor->licencia_medica = $request->licencia_medica;
        $doctor->especialidad = $request->especialidad;
        $doctor->save();

        $usuario->assignRole('doctor');

        return redirect()->route('admin.doctores.index')
            ->with('mensaje', 'Doctor registrado correctamente!')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.doctores.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.doctores.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $doctor = Doctor::find($id);
        
        $request->validate([
            'nombres'=> 'required',
            'apellidos'=> 'required',
            'telefono'=> 'required',
            'licencia_medica'=> 'required',
            'especialidad'=> 'required',
            'email'=> 'required|max:255|unique:users,email,'.$doctor->user->id,
            'password'=> 'nullable|confirmed',
        ]);

        $doctor->nombres = $request->nombres;
        $doctor->apellidos = $request->apellidos;
        $doctor->telefono = $request->telefono;
        $doctor->licencia_medica = $request->licencia_medica;
        $doctor->especialidad = $request->especialidad;
        $doctor->save();

        $usuario = User::find($doctor->user->id);
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        if ($request->filled('password')){
            $usuario->password = Hash::make($request['password']);
        }
        $usuario->save();
        return redirect()->route('admin.doctores.index')
            ->with('mensaje', 'Doctor actualizado correctamente!')
            ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */

     public function confirmDelete($id){
        $doctor = Doctor::findOrFail($id);
        return view('admin.doctores.delete', compact('doctor'));
     }

    public function destroy($id)
    {
        $doctor = Doctor::find($id);

        // Eliminar al usuario asociado
        $user = $doctor->user;
        $user->delete();
        // Eliminar a la secretaria
        $doctor->delete();  

        return redirect()->route('admin.doctores.index')
            ->with('mensaje', 'Doctor eliminado correctamente!')
            ->with('icono', 'success');
    }

    public function reportes(){
        return view('admin.doctores.reportes');
    }

    public function pdf(){
        $configuracion = Configuracion::latest()->first();
        $doctores = Doctor::all();
        //return view('admin.doctores.pdf', compact('doctores', 'configuracion'));
        $pdf = \PDF::loadView('admin.doctores.pdf', compact('configuracion', 'doctores'));
        // Incluir la numeracion de paginas y el pie de pagina
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20, 800, "Impreso por: ".Auth::user()->email, null, 10, array(0,0,0));
        $canvas->page_text(270, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0,0,0));
        $canvas->page_text(450, 800, "Fecha: ".\Carbon\Carbon::now()->format('d/m/Y')." - ".\Carbon\Carbon::now()->format('H:i'), null, 10, array(0,0,0));
        return $pdf->stream();
        
    }

}
