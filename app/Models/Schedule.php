<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['course_id', 'teacher_id', 'classroom_id', 'day', 'start_time', 'end_time',])]
class Schedule extends Model
{
    use HasFactory;
   
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
    
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
    
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
