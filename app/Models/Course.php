<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['category_id', 'department_id', 'code', 'name', 'credits', 'description'])]
class Course extends Model
{
    use HasFactory;
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
    
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
    
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
    
    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments')
            ->withPivot('academic_year', 'semester', 'status')
            ->withTimestamps();
    }
    
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'course_tag')
            ->withTimestamps();
    }
}
