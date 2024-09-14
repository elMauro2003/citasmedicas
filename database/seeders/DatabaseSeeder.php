<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Configuracion;
use App\Models\Consultorio;
use App\Models\Secretaria;
use App\Models\User;
use App\Models\Horario;
use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use function Laravel\Prompts\password;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // hacemos uso del seeder de Roles
        $this->call([RoleSeeder::class]);

        User::create([
            'name'=>'Administrador',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('12345678')
        ])->assignRole('admin');

        User::create([
            'name'=>'Secretaria',
            'email'=>'secretaria@admin.com',
            'password'=>Hash::make('12345678')
        ])->assignRole('secretaria');

        Secretaria::create([
            'nombres'=>'Secretaria',
            'apellidos'=>'1',
            'ci'=>'1223344556',
            'celular'=>'43561234',
            'direccion'=>'LA California // Wallmart Street',
            'fecha_nacimiento'=> '10/2/2001',
            'user_id'=>'2'
        ]);

        User::create([
            'name'=>'Doctor1',
            'email'=>'doctor1@admin.com',
            'password'=>Hash::make('12345678')
        ])->assignRole('doctor');

        Doctor::create([
            'nombres'=> 'Doctor1',
            'apellidos'=> '1',
            'telefono'=> '1223344556',
            'licencia_medica'=> '988776654321',
            'especialidad'=> 'Fisioterapia',
            'user_id'=>'3'
        ]);

        User::create([
            'name'=>'Doctor2',
            'email'=>'doctor2@admin.com',
            'password'=>Hash::make('12345678')
        ])->assignRole('doctor');

        Doctor::create([
            'nombres'=> 'Doctor2',
            'apellidos'=> '2',
            'telefono'=> '1223344556',
            'licencia_medica'=> '988776654321',
            'especialidad'=> 'Radiologia',
            'user_id'=>'4'
        ]);

        User::create([
            'name'=>'Doctor3',
            'email'=>'doctor3@admin.com',
            'password'=>Hash::make('12345678')
        ])->assignRole('doctor');

        Doctor::create([
            'nombres'=> 'Doctor3',
            'apellidos'=> '3',
            'telefono'=> '1223344556',
            'licencia_medica'=> '988776654321',
            'especialidad'=> 'Oftalmología',
            'user_id'=>'5'
        ]);

        User::create([
            'name'=> 'Paciente1',
            'email'=> 'paciente1@nauta.cu',
            'password'=> Hash::make('12345678')
        ])->assignRole('paciente');

        User::create([
            'name'=> 'Usuario1',
            'email'=> 'usuario1@nauta.cu',
            'password'=> Hash::make('12345678')
        ])->assignRole('usuario');

        Consultorio::create([
            'nombre'=> 'Cardiología',
            'ubicacion'=> 'Cienfuegos/Tulipan/Calle 16 // 87 y 89',
            'capacidad'=> '25',
            'telefono'=> '43573770',
            'especialidad'=> 'Cardiología',
            'estado'=> 'ACTIVO',
        ]);

        Consultorio::create([
            'nombre'=> 'Cirujía',
            'ubicacion'=> 'Cienfuegos/Juanita/Calle 29 // 56 y 58',
            'capacidad'=> '10',
            'telefono'=> '43573770',
            'especialidad'=> 'Cirujía',
            'estado'=> 'ACTIVO',
        ]);

        Consultorio::create([
            'nombre'=> 'Oftalmología',
            'ubicacion'=> 'Cienfuegos/Pueblo Grifo/Calle 13 // 21 y 23',
            'capacidad'=> '15',
            'telefono'=> '43573770',
            'especialidad'=> 'Oftalmología',
            'estado'=> 'ACTIVO',
        ]);

        // Llamar al Seeder de Pacientes para usar la Factory del mismo
        $this->call([PacienteSeeder::class]);


        // Creacion de horarios
        Horario::create([
            'dia'=> 'LUNES',
            'hora_inicio'=> '08:00:00',
            'hora_fin'=> '14:00:00',
            'doctor_id'=> '1',
            'consultorio_id'=> '1',
        ]);

        Configuracion::create([
            'nombre'=>'Config1',
            'direccion'=>'Cienfuegos, Tulipan Calle 16 / 87 y 89 Altos',
            'telefono'=>'43573770',
            'correo'=>'mauro2003@nauta.cu',
            'logotipo'=>'logos/QTcuSCT8O3rrUwjPog8Q1zreevZcbPEgxKKvDDxu.png',
        ]);

        // Creacion de una configuracion
        

    }
}
