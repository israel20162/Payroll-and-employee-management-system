<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New') }}
        </h2>
    </x-slot>



</x-app-layout> --}}
<div name='slot'>
    <div class=" p-8 rounded ">
        <h2 class="text-2xl font-bold mb-4">Login</h2>

        @if ($errors->any())
            <div class="bg-red-200 text-red-800 p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('employee.login') }}">
            @csrf

            <section class=" dark:bg-gray-900">
                <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
                    <a href="#"
                        class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                        {{-- <img class="w-8 h-8 mr-2"
                                    src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/logo.svg" alt="logo">
                                Flowbite --}}
                    </a>
                    <div
                        class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                            <h1
                                class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                                Sign in to your account
                            </h1>
                            <div class="space-y-4 md:space-y-6" >
                                <div>
                                    <label for="email"
                                        class="block mb-2 mt-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                        Employee id</label>
                                    <input type="text" name='employee_id'
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="name@company.com" required="">
                                </div>
                                <div>
                                    <label for="password"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                    <input type="password" name="password" id="password" placeholder="••••••••"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        required="">
                                    <span class="text-xs text-gray-600 caption-bottom ">
                                        Default is last name in small letters
                                    </span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-start">

                                    </div>
                                    <a href="#"
                                        class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot
                                        password?</a>
                                </div>
                                <button type="submit"
                                    class="w-full text-white bg-blue-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign
                                    in</button>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
</div>

</html>
