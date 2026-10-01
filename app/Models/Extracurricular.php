<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'description', 'max_members',])]
class Extracurricular extends Model
{
    use HasFactory;
    
    public function students()
    {
        return $this->belongsToMany(Student::class, 'extracurricular_student')
            ->withPivot('joined_at', 'role')
            ->withTimestamps();
    }
}
