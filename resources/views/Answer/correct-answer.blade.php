<x-app-layout>
    @if(session('success'))
        <div class="mx-[20%] mt-2 text-center bg-blue-200 text-lg font-bold text-green-500 rounded" id="success_msg">
            <h3>{{session('success')}}</h3>
        </div>
    @endif

    <div class="font-sans text-gray-900 mt-10 m-auto w-full sm:max-w-md px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        <h3 class="font-bold text-xl text-center">{{$quiz}}</h3>

        <form method="POST" action="{{route('answer-register', $id)}}">
            @csrf
            <label class="mt-4 text-md font-bold block text-gray-700 dark:text-gray-300" for="answer">Correct answer of above quiz</label>
            <input type="text" name="answer" id="answer" class="mt-2 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Correct Answer">

            <label class="mt-4 text-md font-bold block text-gray-700 dark:text-gray-300" for="description">Answer description</label>
            <input type="text" name="description" id="description" class="mt-2 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" placeholder="Answer Description">

            <button type="submit" class="px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 w-[50%] mt-4 ml-[25%]">Add Answer</button>
        </form>
    </div>
</x-app-layout>
