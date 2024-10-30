@php use Illuminate\Support\Facades\Auth; @endphp
<x-app-layout>
    @if(session('message'))
        <div>{{session('message')}}</div>
    @endif
    @if(session()->has('No Data'))
        <h1 class="text-5xl font-bold text-center mt-10">No Quizzes Available</h1>
    @else
        @if($answeredQuizzes)
            <div class="flex justify-between mx-3 mt-2 border rounded-xl shadow-lg bg-white">
                <h1 class="my-2 mx-7 text-2xl font-bold">Check Results</h1>
                <a href="{{route('show-result', [$course_id, Auth::user()->id])}}">
                    <button
                        class="mx-5 my-2 focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">
                        Results
                    </button>
                </a>
            </div>
        @endif
        <div class="grid grid-cols-3 gap-2 m-3">
            @foreach($quizzes as $quiz)
                <form action="{{route('check-answer', [$course_id, $quiz->id])}}" method="post">
                    @csrf
                    <div
                        class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <p class="mb-3 font-normal text-black-700 dark:text-gray-400">{{$quiz->quiz}}</p>
                        <div>
                            <input type="radio" id="choice1-{{$quiz->id}}" value="choice1" name="Answer">
                            <label for="Answer">{{$quiz->choice1}}</label>
                        </div>
                        <div>
                            <input type="radio" id="choice2-{{$quiz->id}}" value="choice2" name="Answer">
                            <label for="Answer">{{$quiz->choice2}}</label>
                        </div>
                        <div>
                            <input type="radio" id="choice3-{{$quiz->id}}" value="choice3" name="Answer">
                            <label for="Answer">{{$quiz->choice3}}</label>
                        </div>
                        <div>
                            <input type="radio" id="choice4-{{$quiz->id}}" value="choice4" name="Answer">
                            <label for="Answer">{{$quiz->choice4}}</label>
                        </div>
                        <button type="submit"
                                class="inline-flex items-center mt-3 mx-[40%] px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Answer
                        </button>
                    </div>
                </form>
            @endforeach
        </div>
    @endif
</x-app-layout>
