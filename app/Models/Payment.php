<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'teacher_id',
        'amount',
        'payment_date',
        'for_month',
        'state',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}