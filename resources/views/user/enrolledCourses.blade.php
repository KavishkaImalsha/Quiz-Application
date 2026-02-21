<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Enrolled Courses</title>
</head>
<body>
<x-app-layout>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('sweetalert::sweetalert')

    <div class="grid grid-cols-3 gap-2 mx-8 my-3">
    @foreach($enrolledCourses as $course)
            @foreach($course as $c)
                <div class="bg-white border rounded shadow-lg group hover:cursor-pointer">
                    <h1 class="text-center font-bold font-jumbotron text-xl py-2 group-hover:text-2xl">{{$c->course_name}}</h1>
                    <p class="text-lg text-gray-400 px-6 group-hover:text-xl">{{$c->description}}</p>
                    <a href=""><button type="button" class="w-[50%] ml-[20%] mt-4 text-white bg-gray-800 hover:w-[60%] hover:ml-[15%] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Attempt to quizzes</button></a>
                </div>
            @endforeach
    @endforeach
    </div>
</x-app-layout>
</body>
</html>
