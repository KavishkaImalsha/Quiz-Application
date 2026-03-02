<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserAnswers extends Model
{
    use HasFactory;

    protected $table = 'user_answers';

    protected $fillable = [
        'course_id',
        'quiz_id',
        'user_id',
        'isCorrect'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(course::class);
    }

    public function quizzes(): BelongsToMany
    {
        return $this->belongsToMany(quiz::class);
    }

    public function answers(): BelongsTo
    {
        return $this->belongsTo(Answer::class);
    }
}
