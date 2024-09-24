<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function (){
        return view('dashboard');

    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/course', [CourseController::class, 'show'])->name('course-register');
    Route::post('/course', [CourseController::class, 'courseRegistrationDatastore']);

    Route::get('/quiz', [QuizController::class, 'show'])->name('quiz-register');
    Route::get('/quiz/{data}', [QuizController::class, 'addQuizzesPage'])->name('add-quizzes');
    Route::post('/quiz/{data}', [QuizController::class, 'store'])->name('quiz-registration');
    Route::get('/quiz/{course_id}/{quiz_id}', [QuizController::class, 'deleteQuiz'])->name('delete-quiz');

    Route::get('/Answer/correct-answer/{data}', [AnswerController::class, 'show'])->name('answer-register');
    Route::post('/Answer/correct-answer/{data}', [AnswerController::class, 'store'])->name('add-answer');
});

Route::middleware(['auth', 'role:user'])->group(function (){
    Route::get('/user/dashboard', function (){
        return view('user.dashboard');
    })->name('user-dashboard');
});


require __DIR__.'/auth.php';
