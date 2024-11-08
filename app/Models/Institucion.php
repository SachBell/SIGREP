<?php

// app/Models/Institucion.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    use HasFactory;

    protected $table = 'instituciones';

    protected $fillable = [
        'nombre',
        'direccion',
    ];

    // Relación con el modelo Formulario
    public function formularios()
    {
        return $this->hasMany(Formulario::class, 'id_institucion');
    }
}