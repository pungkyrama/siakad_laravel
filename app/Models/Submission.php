<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['assignment_id', 'student_id', 'file_path', 'notes', 'submitted_at', 'score',])]
class Submission extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'submitted_at' => 'datetime',
            'score' => 'decimal:2',
        ];
    }
    
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
   
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
