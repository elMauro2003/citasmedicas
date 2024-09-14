<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consultorios', function (Blueprint $table) {
            $table->id();

            $table->string('nombre');
            $table->string('ubicacion');
            $table->string('capacidad');
            $table->string('telefono')->nullable();
            $table->string('especialidad');
            $table->string('estado');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultorios');
    }
};
