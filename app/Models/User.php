<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'userCode',
        'pass_as_string',
        'areaCode',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function monthplan()
    {
        return $this->hasMany(MonthPlan::class, 'user_id');
    }

    public function dailyprogress()
    {
        return $this->hasMany(DailyProgress::class, 'user_id');
    }

    public function monthapproval()
    {
        return $this->hasMany(MonthApproval::class, 'user_id');
    }
}
