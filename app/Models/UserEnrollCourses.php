<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEnrollCourses extends Model
{
    use HasFactory;

    protected $table = 'user_enroll_courses';

    protected $fillable = [
        'userId',
        'courseId'
    ];
}
