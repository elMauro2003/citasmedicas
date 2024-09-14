<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Paciente extends Model
{
    use HasRoles, HasFactory;
    // esto es necesario para poder utilizar el seeder de pacientes con la asignacion de roles
    protected $guard_name = 'web'; 

    public function historial(){
        return $this->hasMany(Historial::class);
    }

}
