<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnswerController extends Controller
{
    public function show($data): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $quiz = DB::select('SELECT quiz FROM quizzes WHERE id=?', [$data]);
        return view('Answer.correct-answer', ['quiz' => $quiz[0]->quiz,'id' => $data]);
    }

    public function store(Request $request, $data)
    {
        $validateRequest = $request->validate([
            'answer' => ['required', 'string'],
            'description' => ['required', 'string']
        ]);

        if($validateRequest){
            $answer = new Answer();

            $answer->quiz_id = $data;
            $answer->answer = $validateRequest['answer'];
            $answer->description = $validateRequest['description'];
            $answer->save();

            session()->flash('Quiz_Add', '!! Quiz successfully added !!');

            $course_id = DB::select('SELECT course_id FROM quizzes WHERE id=?', [$data]);

            return redirect()->route('add-quizzes', $course_id[0]->course_id);
        }
    }

    public function editAnswer($quiz_id, $course_id)
    {
        $answer = DB::select('select * from answers where quiz_id=?', [$quiz_id]);
        return view('Answer.edit-answer', ['answer' => $answer[0], 'course_id' => $course_id]);
    }

    public function updateAnswer(Request $request,$quiz_id, $course_id)
    {
        $validateRequest = $request->validate([
            'answer' => ['required', 'string'],
            'description' => ['required', 'string']
        ]);

        if($validateRequest){
            $answer = Answer::query()->where('quiz_id', $quiz_id)->first();

            $answer->answer = $validateRequest['answer'];
            $answer->description = $validateRequest['description'];
            $answer->update();

            session()->flash('quiz_update', '!!! Quiz update Successful !!!');

            return redirect()->route('add-quizzes', $course_id);
        }
    }
}
