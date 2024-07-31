<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'grade',
        'teacher_id',
        'has_uploads',
        'file_types',
        'max_file_count',
        'state'
    ];

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }
}
