
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$courseName}}
        </h2>
    </x-slot>

    <div class="font-sans text-gray-900 mt-10 m-auto w-full sm:max-w-md px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        @if($errors->any())
            @foreach($errors->all() as $error)
                <div class="bg-red-500 rounded m-2 text-white text-center">
                    <h3>{{$error}}</h3>
                </div>
            @endforeach
        @endif
        <form action="{{route('quiz-registration', $data)}}" method="POST">
            @csrf
            <label for="quiz" class="mt-4 text-md font-bold block text-gray-700 dark:text-gray-300">Enter the quiz</label>
            <input type="text" id="quiz" name="quiz" placeholder="Enter the quiz" autocomplete="off" class="mt-2 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">

            <div class="grid grid-cols-2 gap-2">
                <div>
                    <label for="choice1" class="mt-4 text-md font-bold block text-gray-700 dark:text-gray-300">Choice 01</label>
                    <input type="text" id="choice1" name="choice1" placeholder="Choice 01" autocomplete="off" class="mt-2 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                </div>

                <div>
                    <label for="choice2" class="mt-4 text-md font-bold block text-gray-700 dark:text-gray-300">Choice 02</label>
                    <input type="text" id="choice2" name="choice2" placeholder="Choice 02" autocomplete="off" class="mt-2 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                </div>

                <div>
                    <label for="choice3" class="mt-4 text-md font-bold block text-gray-700 dark:text-gray-300">Choice 03</label>
                    <input type="text" id="choice3" name="choice3" placeholder="Choice 03" autocomplete="off" class="mt-2 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                </div>

                <div>
                    <label for="choice4" class="mt-4 text-md font-bold block text-gray-700 dark:text-gray-300">Choice 04</label>
                    <input type="text" id="choice4" name="choice4" placeholder="Choice 04" autocomplete="off" class="mt-2 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                </div>
            </div>

            <button type="submit" class="px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 w-[50%] mt-4 ml-[25%]">Add Quiz</button>
        </form>
    </div>

    <hr class="w-full bg-gray-400 my-2 h-0.5">

    @if(session('answer_success'))
        <div class="mx-[20%] mt-2 text-center bg-blue-200 text-lg font-bold text-green-500 rounded" id="success_msg">
            <h3>{{session('answer_success')}}</h3>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 shadow max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{'Created Quizzes'}}
        </h2>
    </div>

    @if(sizeof($quizzes) != 0)
        @foreach($quizzes as $quiz)
            <div class="grid grid-cols-4 m-2 bg-white rounded shadow-lg hover:cursor-pointer hover:shadow-2xl">
                <div class="text-center text-lg">
                    <p>{{$quiz->quiz}}</p>
                </div>
                <div class="text-center text-lg">
                    @foreach(json_decode($quiz->choices) as $choice)
                        <ul>
                            <li>{{$choice}}</li>
                        </ul>
                    @endforeach
                </div>
                <div class="grid grid-cols-2">
                    @foreach($answers[$quiz->id] as $answer)
                        <div>
                            <p>{{$answer->answer}}</p>
                        </div>
                        <div>
                            <p>{{$answer->description}}</p>
                        </div>
                    @endforeach
                </div>
                <div>
                    <button type="button" class="mx-10 my-8 text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Edit</button>
                    <button type="button" class="mx-10 my-8 focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-gray-500 text-5xl font-jumbotron text-center">Nothing to show</p>
    @endif
{{--    <script type="text/javascript">--}}
{{--        $("document").ready(function () {--}}
{{--            setTimeout(function (){--}}
{{--                $("div.success_msg").remove();--}}
{{--        }, 1000);--}}
{{--        });--}}
{{--    </script>--}}
</x-app-layout>
