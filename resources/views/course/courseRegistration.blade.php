<x-app-layout>
    <div class="font-sans text-gray-900 mt-20 m-auto w-full sm:max-w-md px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        <form method="POST" action="{{route('course-register')}}">
            @csrf
            <label class="mt-4 text-md font-bold block text-gray-700 dark:text-gray-300" for="course_name">What is the course name?</label>
            <input class="mt-2 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" type="text" name="course_name" id="course_name" placeholder="Course Name">

            <label class="mt-4 text-md font-bold block text-gray-700 dark:text-gray-300" for="description">Content description</label>
            <textarea class="mt-2 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" id="description" name="description" placeholder="Course Description"></textarea>

            <button type="submit" class="px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 w-[50%] mt-4 ml-[25%]">Add Course</button>
        </form>
    </div>
</x-app-layout>
