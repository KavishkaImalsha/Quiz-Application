<?php
    $courses = \Illuminate\Support\Facades\DB::select('select * from courses');
?>

<x-app-layout>
    <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Admin Dashboard') }}
                </h2>
    </x-slot>

    <div class="m-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="">
            <h1 class="text-3xl font-bold text-center font-jumbotron py-5">Did you want to add new course with quiz?</h1>
            <a href="{{url('/course')}}"><button type="button" class="ml-[35%] mb-5 w-[30%] bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full">Add course</button></a>
        </div>
    </div>

    <header class="bg-white dark:bg-gray-800 shadow-lg">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h2 class="font-bold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Created Courses
            </h2>
        </div>
    </header>

    <div class="grid grid-cols-3 gap-2 mx-8 my-3">
        @foreach($courses as $course)
            <div class="bg-white border rounded shadow-lg group hover:cursor-pointer">
                <h1 class="text-center font-bold font-jumbotron text-xl py-2 group-hover:text-2xl">{{$course->course_name}}</h1>
                <p class="text-lg text-gray-400 px-6 group-hover:text-xl">{{$course->description}}</p>
                <a href="{{route('add-quizzes', $course->id)}}"><button type="button" class="w-[50%] ml-[20%] mt-4 text-white bg-gray-800 hover:w-[60%] hover:ml-[15%] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Edit Course</button></a>
            </div>
        @endforeach
    </div>
</x-app-layout>
