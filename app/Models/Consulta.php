<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Servicios;
use App\Models\Producto;

class Consulta extends Model
{
    protected $fillable = [
        'paciente_id', 'motivo', 'notas_padecimiento',
        'edad', 'talla', 'temperatura', 'peso', 'frecuencia_cardiaca',
        'alergias', 'diagnostico', 'notas_receta', 'enfermero_id'
    ];

    public function estudios()
    {
        return $this->hasMany(Servicios::class);
    }

    public function medicamentos()
    {
        return $this->hasMany(Producto::class);
    }
}
