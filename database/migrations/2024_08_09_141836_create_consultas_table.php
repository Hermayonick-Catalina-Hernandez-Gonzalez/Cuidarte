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
        Schema::create('consultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('paciente_id');
            $table->unsignedBigInteger('enfermero_id')->nullable();
            $table->string('motivo');
            $table->text('notas_padecimiento')->nullable();
            $table->integer('edad')->nullable();
            $table->float('talla')->nullable();
            $table->float('temperatura')->nullable();
            $table->float('peso')->nullable();
            $table->integer('frecuencia_cardiaca')->nullable();
            $table->string('alergias')->nullable();
            $table->text('diagnostico')->nullable();
            $table->text('notas_receta')->nullable();
            $table->timestamps();

            // Claves foráneas
            $table->foreign('paciente_id')->references('id')->on('pacientes')->onDelete('cascade');
            $table->foreign('enfermero_id')->references('id')->on('enfermeros')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultas');
    }
};
