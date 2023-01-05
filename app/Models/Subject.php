<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
    ];

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class)->withTimestamps();
    }

    public function grades()
    {
        return $this->belongsToMany(Grade::class);
    }

    public function subject_assignments()
    {
        return $this->hasMany(SubjectAssignment::class);
    }

    public function matchWithTeacherId($teachers)
    {
        foreach($teachers as $t)
        {
            echo $t->name;
        }
    }
}
