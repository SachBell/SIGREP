<?php

// app/Models/Formulario.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formulario extends Model
{
    use HasFactory;

    protected $table = 'formularios';

    protected $fillable = [
        'cei',
        'name',
        'lastname',
        'phone_number',
        'email',
        'address',
        'neighborhood',
        'semester',
        'grade',
        'daytrip',
        'id_institucion',
    ];

    // Relación con el modelo Institucion
    public function institucion()
    {
        return $this->belongsTo(Institucion::class, 'id_institucion');
    }
}
