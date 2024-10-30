<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\quiz;
use App\Models\UserAnswers;
use App\Models\UserEnrollCourses;
use Cassandra\Cluster\Builder;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function attemptQuizzes($courseId)
    {
        //lazy loading attempt here
        $quizess = quiz::whereDoesntHave('userAnswers', function (\Illuminate\Database\Eloquent\Builder $query) use ($courseId){
            $query->where('user_id', Auth::user()->id);
        })->where('course_id', $courseId)->get();

        $ifAnswerQuizExists = DB::table('user_answers')->where('user_id', Auth::user()->id)
            ->where('course_id', $courseId)
            ->exists();
        $answeredQuizzes = false;

        if ($ifAnswerQuizExists){
            $answeredQuizzes = true;
        }
        return \view('user.attemptQuizzes',['quizzes' => $quizess, "course_id" => $courseId, 'answeredQuizzes' => $answeredQuizzes]);
    }

    public function showResult($course_id, $user_id): Factory|Application|View
    {
        $correctAnswerCount = DB::table('user_answers')
            ->where('isCorrect', true)
            ->where('course_id', $course_id)
            ->where('user_id', Auth::user()->id)
            ->count();

        $wrongAnswercount = DB::table('user_answers')
            ->where('isCorrect', false)
            ->where('course_id', $course_id)
            ->where('user_id', Auth::user()->id)
            ->count();

        $totalQuizzes = DB::table('quizzes')
            ->where('course_id',$course_id)
            ->count();

        $answeredQuizzesDetails = DB::table('answers')
            ->whereExists(function ($query) use ($course_id) {
                $query->select(DB::raw(1))
                    ->from('user_answers')
                    ->whereColumn('answers.quiz_id', 'user_answers.quiz_id')
                    ->where('user_answers.course_id', $course_id)
                    ->where('user_answers.user_id', Auth::user()->id);
            })
            ->get();

        $answersQuizzes = DB::table('quizzes')
            ->whereExists(function ($query) use ($course_id) {
                $query->select(DB::raw(1))
                    ->from('user_answers')
                    ->whereColumn('quizzes.id', 'user_answers.quiz_id')
                    ->where('user_answers.course_id', $course_id)
                    ->where('user_answers.user_id', Auth::user()->id);
            })
            ->get();

        $isAnswerCorrect = DB::table('user_answers')
            ->where('course_id', $course_id)
            ->where('user_id', Auth::user()->id)
            ->pluck('isCorrect');

        return \view('user.userResultDashboard', ['course_id' => $course_id ,'totalQuizzes' => $totalQuizzes, 'correct_count' => $correctAnswerCount, 'wrong_count' => $wrongAnswercount, 'answeredQuizzesDetails' => $answeredQuizzesDetails, 'answersQuizzes' => $answersQuizzes, 'isAnswerCorrect' => $isAnswerCorrect]);
    }
}
