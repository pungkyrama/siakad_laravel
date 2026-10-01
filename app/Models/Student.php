<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'department_id', 'nim', 'semester',])]
class Student extends Model
{
    use HasFactory;
        
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
 
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments')
            ->withPivot('academic_year', 'semester', 'status')
            ->withTimestamps();
    }
    
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
    
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
    
    public function extracurriculars()
    {
        return $this->belongsToMany(Extracurricular::class, 'extracurricular_student')
            ->withPivot('joined_at', 'role')
            ->withTimestamps();
    }
}
