<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid/main.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <nav class=" border-b  p-4">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Navbar toggle button for smaller screens -->

            <button class="block lg:hidden p-2 bg-gray-500 toggleSidebar cursor-pointer text-white"
                style="cursor: pointer" id='toggle'>
                <svg class="w-6 h-6 toggleSidebar"style="cursor: pointer" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>
            <!-- Navbar brand/logo -->
            <a href="#" class="text-blue-600 text-2xl">Your Brand</a>
            <div class="hidden lg:flex space-x-4">
                <form action="" class="app-search" method="GET">
                    <div class="relative group ">
                        <input type="text"
                            class="form-input rounded-md bg-slate-200 text-sm  pl-10 py-1.5 ml-5 border-transparent border-none outline-none focus:ring-0 focus:text-white transition-all duration-300 ease-in-out focus:w-60 w-48"
                            placeholder="Search..." autocomplete="off">
                        <span
                            class="absolute left-44 bottom-2 text-gray-400 transition-all duration-300 ease-in-out group-focus-within:left-8">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </span>
                    </div>
                </form>
            </div>
        </div>
    </nav>
    <div class="flex">

        <div class="h-[calc(100vh-64px)] w-1/5  " id="sidebar" style="height: calc(100vh - 64px)">
            <!-- Sidebar content goes here -->
            <!-- Sidebar -->
            <aside x-transition:enter="transition transform duration-300"
                x-transition:enter-start="-translate-x-full opacity-30  ease-in"
                x-transition:enter-end="translate-x-0 opacity-100 ease-out"
                x-transition:leave="transition transform duration-300"
                x-transition:leave-start="translate-x-0 opacity-100 ease-out"
                x-transition:leave-end="-translate-x-full opacity-0 ease-in"
                class="fixed inset-y-0 z-10 flex flex-col flex-shrink-0 w-64 max-h-screen overflow-hidden transition-all transform bg-white border-r duration-150 ease-linear shadow-lg lg:z-auto lg:static lg:shadow-none"
                :class="{ '-translate-x-full lg:translate-x-0 lg:w-20': !isSidebarOpen }"
                class="h-full !w-full my-auto py-auto" style="height: 100%">
                <!-- sidebar header -->
                <div class="flex items-center justify-between flex-shrink-0 p-2"
                    :class="{ 'lg:justify-center': !isSidebarOpen }">
                    <span class="p-2 text-xl font-semibold leading-8 tracking-wider uppercase whitespace-nowrap">
                        K<span :class="{ 'lg:hidden': !isSidebarOpen }">-WD</span>
                    </span>
                    <button class="p-2 rounded-md lg:hidden toggleSidebar">
                        <svg class="w-6 h-6 text-gray-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <!-- Sidebar links -->
                <nav class="flex-1 overflow-hidden hover:overflow-y-auto">
                    <ul class="p-2 overflow-hidden">
                        <li>
                            <a href={{route('employee.dashboard',['id'=> session('user')->employee_id])}} class="flex items-center p-2 space-x-2 rounded-md hover:bg-gray-100"
                                :class="{ 'justify-center': !isSidebarOpen }">
                                <span>
                                    <svg class="w-6 h-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </span>
                                <span :class="{ 'lg:hidden': !isSidebarOpen }">Dashboard</span>
                            </a>
                        </li>
                                                <li>
                            <a href={{route('employee.calender',['id'=> session('user')->employee_id])}} class="flex items-center p-2 space-x-2 rounded-md hover:bg-gray-100"
                                :class="{ 'justify-center': !isSidebarOpen }">
                                <span>
                                    <svg class="w-6 h-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </span>
                                <span :class="{ 'lg:hidden': !isSidebarOpen }">Calender</span>
                            </a>
                        </li>
                             </li>
                                                <li>
                            <a href={{route('employee.payHistory',['id'=> session('user')->employee_id])}} class="flex items-center p-2 space-x-2 rounded-md hover:bg-gray-100"
                                :class="{ 'justify-center': !isSidebarOpen }">
                                <span>
                                    <svg class="w-6 h-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </span>
                                <span :class="{ 'lg:hidden': !isSidebarOpen }">payslip</span>
                            </a>
                        </li>
                        <!-- Sidebar Links... -->
                    </ul>
                </nav>
                <!-- Sidebar footer -->
                <div class="flex-shrink-0 p-2 border-t max-h-14">
                    <button
                        class="flex items-center justify-center w-full px-4 py-2 space-x-1 font-medium tracking-wider uppercase bg-gray-100 border rounded-md focus:outline-none focus:ring toggleSidebar">
                        <span>
                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </span>
                        <span :class="{ 'lg:hidden': !isSidebarOpen }"> Logout </span>
                    </button>
                </div>
            </aside>
        </div>


        <!-- Main content -->
        <div class="flex-1">
            {{ $slot }}
        </div>
    </div>

    <!-- Toggle sidebar button -->







    @stack('scripts')
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
