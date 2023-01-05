<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use HasFactory, SoftDeletes;

    protected $filable = [
        "day",
        "time",
        "teacher_id",
        "subject_id",
        "section_id",
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    
}
