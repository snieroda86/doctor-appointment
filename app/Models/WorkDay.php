<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'date' , 
        'day_name'
    ];

    // AvailableDate
    public function availableDates()
    {
        return $this->hasMany(AvailableDate::class , 'work_days_id');
    }
}
