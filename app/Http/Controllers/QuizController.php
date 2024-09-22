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
        $quizzes_details = DB::select('SELECT * FROM quizzes WHERE course_id=?', [$data]);
        $answers = [];
        foreach ($quizzes_details as $quiz){
            $answer = DB::select('select * from answers where quiz_id = ?', [$quiz->id]);
            $answers[$quiz->id] = $answer;
        }
        return view('quiz.add-quizzes',['courseName' => $courseName[0]->course_name, 'data' => $data, 'quizzes' => $quizzes_details, 'answers' => $answers]);
    }

    public function course_overview($course_id, $quiz_id){

    }

    public function store(Request $request, $data){
        $validateRequest = $request->validate([
            'quiz' => ['required', 'string', 'unique:quizzes'],
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

            $quiz_id = DB::select("SELECT id FROM quizzes WHERE quiz=?", [$validateRequest['quiz']]);

            return redirect()->route( "answer-register", [$quiz_id[0]->id]);
        }
    }
}
