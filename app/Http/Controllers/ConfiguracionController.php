<?php

namespace App\Http\Controllers;

use App\Models\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfiguracionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $configuraciones = Configuracion::all();
        return view('admin.configuracion.index', compact('configuraciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.configuracion.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = $request->all();
        //return response()->json($datos);
        //dd($request->all(), $request->file('logotipo));

        $request->validate([
            'nombre'=>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'correo'=>'required',
        ]);

        $configuracion = new Configuracion();
        $configuracion->nombre = $request->nombre;
        $configuracion->direccion = $request->direccion;
        $configuracion->telefono = $request->telefono;
        $configuracion->correo = $request->correo;
        $configuracion->logotipo = $request->file('logotipo')->store('logos', 'public');
        $configuracion->save();

        return redirect()->route('admin.configuracion.index')
            ->with('mensaje','Se registró la configuración de manera correcta!')
            ->with('icono','success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $configuracion = Configuracion::find($id);
        return view('admin.configuracion.show', compact('configuracion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $configuracion = Configuracion::find($id);
        return view('admin.configuracion.edit', compact('configuracion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'=>'required',
            'direccion'=>'required',
            'telefono'=>'required',
            'correo'=>'required',
            'logotipo'=>'required',
        ]);

        $configuracion = Configuracion::find($id);
        $configuracion->nombre = $request->nombre;
        $configuracion->direccion = $request->direccion;
        $configuracion->telefono = $request->telefono;
        $configuracion->correo = $request->correo;

        // si se puso una nueva imagen pues se reemplaza
        if ($request->hasFile('logotipo')){
            Storage::delete('public/'.$configuracion->logotipo);
            $configuracion->logotipo = $request->file('logotipo')->store('logos', 'public');
        }
        
        $configuracion->save();

        return redirect()->route('admin.configuracion.index')
            ->with('mensaje','Configuración actualizada de manera correcta!')
            ->with('icono','success');
    }

    /**
     * Remove the specified resource from storage.
     */

     public function confirmDelete($id){
        $configuracion = Configuracion::find($id);
        return view('admin.configuracion.delete', compact('configuracion'));
     }

    public function destroy($id)
    {
        $configuracion = Configuracion::find($id);
        Storage::delete('public/'.$configuracion->logotipo);
        Configuracion::destroy($id);
        return redirect()->route('admin.configuracion.index')
            ->with('mensaje','Configuración eliminada correctamente!')
            ->with('icono','success');
    }

}
