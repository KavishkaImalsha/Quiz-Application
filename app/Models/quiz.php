<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quiz extends Model
{
    use HasFactory;

    protected $table = 'quizzes';

    protected $fillable = [
        'course_id',
        'quiz',
        'choices1',
        'choices2',
        'choices3',
        'choices4',
    ];
}
