<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['student_id', 'course_id', 'academic_year', 'midterm_score', 'final_score', 'grade_letter'])]
class Grade extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'midterm_score' => 'decimal:2',
            'final_score' => 'decimal:2',
        ];
    }
   
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
