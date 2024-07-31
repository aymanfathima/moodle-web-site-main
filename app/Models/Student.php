<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'first_name',
        'last_name',
        'parent_name',
        'grade',
        'phone',
        'address',
        'profile_picture',
        'created_by',
        'created_by_role',
        'state',
    ];

    protected $hidden = [
        'password',
    ];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function answers()
    {
        return $this->hasMany(Answers::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
