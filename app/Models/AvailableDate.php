<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AvailableDate extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_days_id' , 
        'available_time'
    ];

    public function workDay()
    {
        return $this->belongsTo(WorkDay::class);
    }
}
