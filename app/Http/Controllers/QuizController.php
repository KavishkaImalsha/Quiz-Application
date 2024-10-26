<?php

namespace App\Http\Controllers;

use App\Models\quiz;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use function Laravel\Prompts\select;

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
            $answerDetails = DB::select('select * from answers where quiz_id = ?', [$quiz->id]);
            $column = $answerDetails[0]->answer;
            $correctAnswer = DB::table('quizzes')
                ->where('id', $quiz->id)
                ->value($column);
            $answers[$quiz->id] = ['answer' => $correctAnswer, 'desc' => $answerDetails[0]->description];
        }
        return view('quiz.add-quizzes',['courseName' => $courseName[0]->course_name, 'course_id' => $data, 'quizzes' => $quizzes_details, 'answers' => $answers]);
    }

    public function deleteQuiz($course_id, $quiz_id): RedirectResponse
    {
        DB::table('quizzes')->where('id', '=', $quiz_id)->delete();
        DB::table('answers')->where('quiz_id', '=', $quiz_id)->delete();

        return redirect()->route('add-quizzes', $course_id);
    }

    public function store(Request $request, $data){
        $validateRequest = $request->validate([
            'quiz' => ['required', 'string', 'unique:quizzes'],
            'choice1' => ['required', 'string'],
            'choice2' => ['required', 'string'],
            'choice3' => ['required', 'string'],
            'choice4' => ['required', 'string'],
            'correct' => ['required'],
            'description' => ['required', 'string']
        ]);

        if($validateRequest){
            $quiz = new quiz();

            $quiz->course_id = $data;
            $quiz->quiz = $validateRequest['quiz'];
            $quiz->choice1 = $validateRequest['choice1'];
            $quiz->choice2 = $validateRequest['choice2'];
            $quiz->choice3 = $validateRequest['choice3'];
            $quiz->choice4 = $validateRequest['choice4'];
            $quiz->save();

            session()->flash('success', '!! Quiz is successfully added !!');

            return redirect()->route('add-answer',['quiz_id' => $quiz->id, 'correctAnswer' => $validateRequest['correct'], 'description' => $validateRequest['description']]);

        }
    }

    public function edit($course_id, $quiz_id): Factory|Application|View
    {
        $quizDetails = DB::table('quizzes')->where('id', $quiz_id)->first();
        $answerDetails = DB::table('answers')->where('quiz_id', $quiz_id)->first();
        $correctAnswer = DB::table('quizzes')->where('id', $quiz_id)->value($answerDetails->answer);
        return \view('quiz.edit-quiz', ['quizDetails' => $quizDetails, 'answerDetails' => $answerDetails, 'correctAnswer' => $correctAnswer, 'course_id' => $course_id]);
    }

    public function update(Request $request, $quiz_id, $course_id): RedirectResponse
    {
        $validateRequest = $request->validate([
            'quiz' => ['required', 'string'],
            'choice1' => ['required', 'string'],
            'choice2' => ['required', 'string'],
            'choice3' => ['required', 'string'],
            'choice4' => ['required', 'string'],
            'correct' => ['required'],
            'description' => ['required', 'string']
        ]);

        if($validateRequest){

            $quiz = quiz::find($quiz_id);
            $quiz->course_id = $course_id;
            $quiz->quiz = $validateRequest['quiz'];
            $quiz->choice1 = $validateRequest['choice1'];
            $quiz->choice2 = $validateRequest['choice2'];
            $quiz->choice3 = $validateRequest['choice3'];
            $quiz->choice4 = $validateRequest['choice4'];
            $quiz->save();
        }
        return redirect()->route('update-answer', [$quiz_id, $course_id, $validateRequest['correct'], $validateRequest['description']]);
    }
}
