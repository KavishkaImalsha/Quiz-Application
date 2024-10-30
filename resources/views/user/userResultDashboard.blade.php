<x-app-layout>
    <div class="grid grid-cols-2 gap-4 mx-10">
        <div class="bg-white my-3 border rounded-lg shadow-lg">
            <div id="donutchart"></div>
        </div>
        <div class="bg-white border rounded-lg my-3 w-24">
            <ul class="text-center p-6">
                <li class="pt-5 text-lg font-bold">Total Quizzes : {{$totalQuizzes}}</li>
                <li class="pt-5 text-lg font-bold">Correct Answer Count : {{$correct_count}}</li>
                <li class="pt-5 text-lg font-bold">Wrong Answer Count : {{$wrong_count}}</li>
            </ul>
            <a href="{{route('attempt-quizzes', [$course_id])}}"><button class="mx-10 w-[70%] my-2 focus:outline-none text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:ring-purple-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900">Back to the quizzes</button></a>
        </div>
    </div>

    @for($i = 0; $i < count($answersQuizzes); $i++)
        <div class="bg-white border rounded-lg shadow-lg my-3 mx-10">
            <p class="p-5">{{$answersQuizzes[$i]->quiz}}</p>
            @if($isAnswerCorrect[$i])
                <div class="mx-10 border rounded-lg">
                    <p class="text-green-500 p-2 text-lg font-bold">Answer is correct</p>
                </div>
            @else
                <div class="mx-10 border rounded-lg">
                    <p class="text-red-500 p-2 text-lg font-bold">Answer is wrong</p>
                </div>
            @endif
            <div class="bg-blue-200 mx-10 border rounded-lg my-3">
                <h1 class="text-gray-500 m-2">Answer Description</h1>
                <p class="px-5 font-bold">{{$answeredQuizzesDetails[$i]->description}}</p>
            </div>

        </div>
    @endfor
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Status', 'count'],
                ['Correct Answers', {{$correct_count}}],
                ['Wrong Answers',      {{$wrong_count}}],
            ]);

            var options = {
                title: 'Result Summary',
                pieHole: 0.4,
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>
</x-app-layout>
