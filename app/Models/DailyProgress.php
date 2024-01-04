<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyProgress extends Model
{
    use HasFactory;
    protected $fillable  = [
        'month',
        'date',
        'year',
        'user_id',
        'state',
        'cardCode',
        'company'
    ];
}
