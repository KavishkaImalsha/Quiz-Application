
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-center font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{$courseName}}
        </h2>
    </x-slot>

    <div class="font-sans text-gray-900 mt-10 m-auto w-full sm:max-w-md px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        <form action="{{route('quiz-registration', $data)}}" method="POST">
            @csrf
            <label for="quiz" class="mt-4 text-md font-bold block text-gray-700 dark:text-gray-300">Enter the quiz</label>
            <input type="text" id="quiz" name="quiz" placeholder="Enter the quiz" class="mt-2 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">

            <label for="choice1" class="mt-4 text-md font-bold block text-gray-700 dark:text-gray-300">Choice 01</label>
            <input type="text" id="choice1" name="choice1" placeholder="Choice 01" class="mt-2 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">

            <label for="choice2" class="mt-4 text-md font-bold block text-gray-700 dark:text-gray-300">Choice 02</label>
            <input type="text" id="choice2" name="choice2" placeholder="Choice 02" class="mt-2 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">

            <label for="choice3" class="mt-4 text-md font-bold block text-gray-700 dark:text-gray-300">Choice 03</label>
            <input type="text" id="choice3" name="choice3" placeholder="Choice 03" class="mt-2 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">

            <label for="choice4" class="mt-4 text-md font-bold block text-gray-700 dark:text-gray-300">Choice 04</label>
            <input type="text" id="choice4" name="choice4" placeholder="Choice 04" class="mt-2 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">

            <button type="submit" class="px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 w-[50%] mt-4 ml-[25%]">Add Quiz</button>
        </form>
    </div>
    <script type="text/javascript">
        $("document").ready(function () {
            setTimeout(function (){
                $("div.success_msg").remove();
        }, 1000);
        });
    </script>
</x-app-layout>
