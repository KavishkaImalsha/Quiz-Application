<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;
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
    Route::get('/quiz/edit-quiz//{course_id}/{quiz_id}', [QuizController::class, 'edit'])->name('edit-blade');
    Route::put('/quiz/edit-quiz/{quiz_id}/{course_id}',[QuizController::class, 'update'])->name('update-quiz');

    Route::get('/Answer/correct-answer/{data}', [AnswerController::class, 'show'])->name('answer-register');
    Route::get('/Answer/correct-answer/{quiz_id}/{correctAnswer}/{description}', [AnswerController::class, 'store'])->name('add-answer');
    Route::get('/Answer/edit-answer/{quiz_id}/{course_id}', [AnswerController::class, 'editAnswer'])->name('edit-answer');
    Route::get('/Answer/edit-answer/{quiz_id}/{course_id}/{correctAnswer}/{desc}', [AnswerController::class, 'updateAnswer'])->name('update-answer');
});

Route::middleware(['auth', 'role:user'])->group(function (){
    Route::get('/user/dashboard', [UserController::class, 'userHome'])->name('user-dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/user/user-enroll-courses/{userId}/{courseId}', [UserController::class, 'userEnrollCourses'])->name('enroll-course');
    Route::get('/user/user-enroll-courses/{userId}', [UserController::class, 'userEnrolledCourses'])->name('enrolled-courses');
});


require __DIR__.'/auth.php';
