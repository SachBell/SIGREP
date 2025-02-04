<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institute extends Model
{
    use HasFactory;

    protected $table = 'institutes';

    protected $fillable = [
        'name',
        'address',
        'user_limit'
    ];

    public function applicatonDetails()
    {
        return $this->hasMany(ApplicationDetails::class, 'id_institute');
    }
}
