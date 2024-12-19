<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institucion extends Model
{
    use HasFactory;

    protected $table = 'institutes';

    protected $fillable = [
        'name',
        'address',
        'user_limit'
    ];

    public function userData() {
        return $this->belongsTo(UserData::class, 'id_institute');
    }
}