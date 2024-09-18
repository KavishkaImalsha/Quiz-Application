<?php
    $courses = [
        ['name' => 'Introduction to Software Engineering', 'des' => "Learn the basics of software development, design principles, and methodologies. This quiz covers key concepts like the software development life cycle (SDLC), version control, and agile practices. Perfect for beginners looking to build a solid foundation!"],
        ['name' => 'Data Structures and Algorithms', 'des' => "Master the essential data structures (arrays, linked lists, trees) and algorithms (sorting, searching, recursion) that every software engineer needs to know. These quizzes will test your problem-solving skills and logic"],
        ['name' => 'Object-Oriented Programming (OOP)', 'des' => "Dive into the core principles of object-oriented programming, including encapsulation, inheritance, and polymorphism. Test your knowledge with real-world coding scenarios and challenges focused on Java, Python, and C++."],
    ];
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
                <h1 class="text-center font-bold font-jumbotron text-xl py-2 group-hover:text-2xl">{{$course['name']}}</h1>
                <p class="text-lg text-gray-400 px-6 group-hover:text-xl">{{$course['des']}}</p>
                <button type="button" class="w-[50%] ml-[20%] mt-4 text-white bg-gray-800 hover:w-[60%] hover:ml-[15%] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Edit Course</button>
            </div>
        @endforeach
    </div>
</x-app-layout>
