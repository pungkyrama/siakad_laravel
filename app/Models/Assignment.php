<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['course_id', 'title', 'description', 'due_date',])]
class Assignment extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'due_date' => 'datetime',
        ];
    }
    
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
   
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
