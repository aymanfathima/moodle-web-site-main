<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type', //pdf link, video link, image link, audio link, zip link
        'link',
        'description',
        'lesson_id',
        'grade',
        'state',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
