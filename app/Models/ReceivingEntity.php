<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class ReceivingEntity extends Model
{
    use HasFactory, Searchable;

    protected $table = 'receiving_entities';

    protected $fillable = [
        'name',
        'address',
        'user_limit',
        'productive_sector',
        'id_pincipal',
        'observations',
        'convenant_start_date',
        'convenant_end_date',
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
