<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultorio extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'ubicacion', 'capacidad', 'telefono', 'especialidad', 'estado'];

    // Relacion de uno a muchos
    public function doctores(){
        return $this->hasMany(Doctor::class);
    }

    // Relacion de uno a muchos
    public function horarios(){
        return $this->hasMany(Horario::class);
    }

    public function events(){
        return $this->hasMany(Event::class);
    }
}
