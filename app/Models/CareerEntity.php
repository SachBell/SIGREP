<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerEntity extends Model
{
    use HasFactory;

    protected $table = 'career_entities';

    protected $fillable = [
        'career_id',
        'entity_id'
    ];
}
