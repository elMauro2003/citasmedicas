<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Event;
use App\Models\Horario;
use App\Models\Configuracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = $request->all();
        //return response()->json($datos);

        $request->validate([
            'fecha_reserva'=>'required|date',
            'hora_reserva'=>'required|date_format:H:i',
        ]);

        $doctor = Doctor::find($request->doctor_id);
        $fechaReserva = $request->fecha_reserva;
        $horaReserva = $request->hora_reserva.':00';

        $dia = date('l',strtotime($fechaReserva));
        $dia_de_reserva = $this->traducir_dia($dia);

        //valida si existe el horario del doctor
        $horarios = Horario::where('doctor_id',$doctor->id)
            ->where('dia',$dia_de_reserva)
            ->where('hora_inicio','<=',$horaReserva)
            ->where('hora_fin','>=',$horaReserva)
            ->exists();

        if(!$horarios){
            return redirect()->back()->with([
                'mensaje' => 'El doctor no esta disponible en ese horario.',
                'icono' => 'error',
                'hora_reserva'=> 'El doctor no esta disponible en ese horario.',
            ]);
        }

        $fecha_hora_reserva = $fechaReserva." ".$horaReserva;

        /// valida si existen eventos duplicado
        $eventos_duplicados = Event::where('doctor_id',$doctor->id)
            ->where('start', $fecha_hora_reserva)
            ->exists();

        if($eventos_duplicados){
            return redirect()->back()->with([
                'mensaje' => 'Ya existe una reserva con el mismo doctor en esa fecha y hora!',
                'icono' => 'error',
                'hora_reserva'=> 'Ya existe una reserva con el mismo doctor en esa fecha y hora!',
            ]);
        }


        $event = new Event();
        $event->title = $request->hora_reserva." ".$doctor->especialidad;
        $event->start = $request->fecha_reserva." ".$horaReserva;
        $event->end = $request->fecha_reserva." ".$horaReserva;
        $event->color = '#e82216';
        $event->user_id = Auth::user()->id;
        $event->doctor_id  = $request->doctor_id;
        $event->consultorio_id = '1';
        $event->save();

        return redirect()->route('admin.index')
            ->with('mensaje','Se registró la reserva de la cita medica la manera correcta!')
            ->with('icono','success');

    }

    private function traducir_dia($dia){
        $dias=[
            'Monday' => 'LUNES',
            'Tuesday' => 'MARTES',
            'Wednesday' => 'MIERCOLES',
            'Thursday' => 'JUEVES',
            'Friday' => 'VIERNES',
            'Saturday' => 'SABADO',
            'Sunday' => 'DOMINGO',
        ];
        return $dias[$dia]??$dias;
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Event::destroy($id);

        return redirect()->route('admin.index')
            ->with('mensaje','Reserva eliminada correctamente!')
            ->with('icono','success');
    }

    public function reportes(){
        return view('admin.reservas.reportes');
    }

    public function pdf(){
        $configuracion = Configuracion::latest()->first();
        $eventos = Event::all();
        //return view('admin.doctores.pdf', compact('eventos', 'configuracion'));
        $pdf = \PDF::loadView('admin.reservas.pdf', compact('configuracion', 'eventos'));
        // Incluir la numeracion de paginas y el pie de pagina
        $pdf->output();
        $dompdf = $pdf->getDomPDF();
        $canvas = $dompdf->getCanvas();
        $canvas->page_text(20, 800, "Impreso por: ".Auth::user()->email, null, 10, array(0,0,0));
        $canvas->page_text(270, 800, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0,0,0));
        $canvas->page_text(450, 800, "Fecha: ".\Carbon\Carbon::now()->format('d/m/Y')." - ".\Carbon\Carbon::now()->format('H:i'), null, 10, array(0,0,0));
        return $pdf->stream();
    }

    public function pdf_fechas(Request $request){
        //$datos = request()->all();
        //return response()->json($datos);
        $configuracion = Configuracion::latest()->first();
        $fecha_inicio = $request->input('fecha_inicio');
        $fecha_fin = $request->input('fecha_fin');
        $eventos = Event::whereBetween('start',[$fecha_inicio, $fecha_fin])->get();
        
        $pdf = \PDF::loadView('admin.reservas.pdf_fechas', compact('configuracion', 'eventos', 'fecha_inicio', 'fecha_fin'));
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
