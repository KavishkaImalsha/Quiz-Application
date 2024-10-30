<?php

namespace App\Http\Controllers;

use App\Models\course;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function show(): View|Factory|Application
    {
        return view('course.courseRegistration');
    }

    public function courseRegistrationDatastore(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validateRequest = $request->validate(
            [
                'course_name' => ['required', 'string'],
                'description' => ['required', 'string']
            ]
        );

        if($validateRequest){
            $course = new course();

            $course->course_name = $validateRequest['course_name'];
            $course->description = $validateRequest['description'];
            $course->save();
        }

        return redirect()->route('quiz-register');
    }
}
