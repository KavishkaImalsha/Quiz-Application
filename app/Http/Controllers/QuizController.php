<?php

namespace App\Http\Controllers;

use App\Models\quiz;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizController extends Controller
{
    public function show(): View|Factory|Application
    {
        return  view('quiz.quiz-registration');
    }

    public function addQuizzesPage($data): View|Factory|Application
    {
        $courseName = DB::select('select course_name from courses where id=?', [$data]);

        return view('quiz.add-quizzes',['courseName' => $courseName[0]->course_name, 'data' => $data]);
    }

    public function store(Request $request, $data){
        $validateRequest = $request->validate([
            'quiz' => ['required', 'string'],
            'choice1' => ['required', 'string'],
            'choice2' => ['required', 'string'],
            'choice3' => ['required', 'string'],
            'choice4' => ['required', 'string'],
        ]);

        if($validateRequest){
            $choices = [$validateRequest['choice1'], $validateRequest['choice2'], $validateRequest['choice3'], $validateRequest['choice4']];

            $quiz = new quiz();

            $quiz->course_id = $data;
            $quiz->quiz = $validateRequest['quiz'];
            $quiz->choices = json_encode($choices);
            $quiz->save();

            session()->flash('success', '!! Quiz is successfully added !!');

            return redirect()->route( "answer-register");
        }
    }
}
