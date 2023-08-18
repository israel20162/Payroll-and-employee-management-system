<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>


<div>
    <!-- Loading screen -->
    {{-- <div
        x-ref="loading"
        class="fixed inset-0 z-50 flex items-center justify-center text-white bg-black bg-opacity-50"
        style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"
      >
        Loading.....
      </div> --}}

    <!-- Sidebar backdrop -->
    <div x-show.in.out.opacity="isSidebarOpen" class="fixed inset-0 z-10 bg-black bg-opacity-20 lg:hidden"
        style="backdrop-filter: blur(14px); -webkit-backdrop-filter: blur(14px)"></div>

    <!-- Sidebar -->
    <x-employee-layout>
        <x-slot name='slot'>
            <div class="container mx-auto py-8">
                <div class="flex justify-between">
                    <h1 class="text-3xl font-bold mb-4 capitalize">Welcome, {{ $employee->name }}!</h1>
                    <div class=" flex items-center pb-2" style="padding-right: 15px">Check In Time:
                        <span class="text-sm">{{ $check_in_time }}</span>
                        <a href="{{ route('employee.logout', ['id' => $employee->employee_id]) }}" class="m-0 p-0"
                            method="POST">
                            @method('POST')
                            <button type='submit' style="margin: 1px 5px"
                                class="px-4 py-1 rounded bg-red-500 text-white">Clock out</button>
                        </a>

                    </div>
                </div>



                <div class="bg-white shadow-md rounded-lg p-6 flex justify-between flex-row-reverse items-center">
                    <div class="flex-shrink-0 mr-4">
                        @if ($employee->image)
                            {{-- If the user has an image, display it --}}
                            <img src="{{ Auth::user()->image }}" alt="Profile Picture" class="w-16 h-16 rounded-full">
                        @else
                            {{-- If the user does not have an image, display a dummy SVG --}}
                            <img src="{{ asset('avatar.svg') }}" height="120px" width="120px"
                                class="p-2 rounded-full bg-gray-300" />
                        @endif
                    </div>

                    <div>
                        <h2 class="text-xl font-semibold mb-2">Personal Information</h2>
                        <p class="mb-1 capitalize"><strong>Name:</strong> {{ $employee->name }}</p>
                        {{-- Replace `Auth::user()->name` with the method to retrieve the employee's name --}}

                        <p class="mb-1"><strong>Employee id:</strong> {{ $employee->employee_id }}</p>
                        <p class="mb-1 capitalize"><strong>Department:</strong> {{ $employee->department }}</p>
                        <p class="mb-1 capitalize"><strong>Positioned:</strong> {{ $employee->position }}</p>

                    </div>
                </div>

                {{-- You can add more sections or features here, e.g., recent activities, notifications, etc. --}}
            </div>
        </x-slot>

    </x-employee-layout>



</div>
