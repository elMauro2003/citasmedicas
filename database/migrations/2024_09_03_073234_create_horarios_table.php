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
        Schema::create('horarios', function (Blueprint $table) {
            $table->id();

            $table->string('dia');
            $table->time('hora_inicio');
            $table->time('hora_fin');
        
            $table->foreignId('doctor_id')
                ->constrained('doctors')
                ->onDelete('cascade');
            
            $table->foreignId('consultorio_id')
                ->constrained('consultorios')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
