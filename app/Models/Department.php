<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'code', 'description',])]
class Department extends Model
{
    use HasFactory;
        
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
    
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
