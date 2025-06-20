<?php

namespace App\Models;

use App\Traits\HasCareerScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationCall extends Model
{
    use HasFactory, HasCareerScope;

    protected $table = 'application_calls';

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'career_id',
        'status'
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($status) {
            $now = Carbon::now();

            if (!$status->start_date || !$status->end_date) {
                return;
            }

            if ($status->start_date <= $now && $status->end_date >= $now) {
                $status->status = 'Activo';
            }

            if ($status->end_date < $now) {
                $status->status = 'Finalizado';
            }
        });
    }

    public function career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }

    public function applicationDetail()
    {
        return $this->hasMany(ApplicationDetail::class, 'application_calls_id');
    }
}
