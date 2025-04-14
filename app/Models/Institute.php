<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Institute extends Model
{
    use HasFactory, Searchable;

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

    public function toSearchableArray()
    {

        return [
            'name' => $this->name,
            'address' => $this->address,
            'user_limit' => $this->address,
        ];
    }
}
