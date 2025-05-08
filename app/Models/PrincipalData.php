<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrincipalData extends Model
{
    use HasFactory;

    protected $table = 'principal_data';

    protected $fillable = [
        'name',
        'lastname',
        'id_card',
        'email',
        'phone_number'
    ];
}
