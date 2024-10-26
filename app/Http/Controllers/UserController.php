<?php

namespace App\Http\Controllers;

use App\Models\UserEnrollCourses;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use MongoDB\Driver\Session;
use Wavey\Sweetalert\Sweetalert;

class UserController extends Controller
{
    public function userHome(): View|Factory|Application
    {
        $courses = DB::table('courses')->get();
        return view('user.dashboard')->with('courses', $courses);
    }

    public function userEnrolledCourses($userId): Factory|Application|View
    {
        $enrolledCoursesId = DB::table('user_enroll_courses')->where('userId', $userId)->pluck('courseId');
        $enrolledCoursesDetails = [];
        foreach ($enrolledCoursesId as $id){
            $courseDetails = DB::table('courses')->select('course_name', 'description', 'id')->where('id', $id)->get();
            $enrolledCoursesDetails[] = $courseDetails;
        }
        return \view('user.enrolledCourses', ['enrolledCourses' => $enrolledCoursesDetails]);
    }

    public function userEnrollCourses($userId ,$courseId): RedirectResponse
    {
        $courseCount = DB::table('user_enroll_courses')->where('userId', $userId)->where('courseId', $courseId)->exists();

        if(!$courseCount){
            $enrollCourse = new UserEnrollCourses();
            $enrollCourse->userId = $userId;
            $enrollCourse->courseId = $courseId;
            $enrollCourse->save();

            Sweetalert::success('You enrolled course successfully', 'Grate Job');

            return \redirect()->route('enrolled-courses', [$userId]);
        }
        else{
            Sweetalert::warning('You already enrolled this course', 'Oops...');
            return \redirect()->route('enrolled-courses', [$userId]);
        }

    }
}
