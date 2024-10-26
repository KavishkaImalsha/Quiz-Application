<?php
?>

    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>user dashboard</title>
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Offered Courses') }}
        </h2>
    </x-slot>
    <div class="grid grid-cols-3 gap-2 mx-8 my-3">
        @foreach($courses as $course)
            <div class="bg-white border rounded shadow-lg group hover:cursor-pointer">
                <h1 class="text-center font-bold font-jumbotron text-xl py-2 group-hover:text-2xl">{{$course->course_name}}</h1>
                <p class="text-lg text-gray-400 px-6 group-hover:text-xl">{{$course->description}}</p>
                <a href="{{route('enroll-course', [Auth::user()->id, $course->id])}}"><button type="button" class="w-[50%] ml-[20%] mt-4 text-white bg-gray-800 hover:w-[60%] hover:ml-[15%] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Enroll Now</button></a>
            </div>
        @endforeach
    </div>
</x-app-layout>
</body>
</html>
