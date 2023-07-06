<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Mata Tags -->
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Employees</title>
</head>

<body>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Employees') }}
            </h2>
        </x-slot>

        <x-slot name="slot">
            <div class='bg-gray-60 mt-4 border-none  ' style='border:none;background-color:whit;max-width:100%;'>
                <form action='/search'method='POST' class='bg-transparent' role='search'>
                    @csrf
                    <div class=' items-center justify-end flex gap-1 bg-inherit ' style='background-color:transparent'>
                        <input type='text' class='form-control rounded form-input  m-2 px-2' name='q'
                            placeholder='Search Employees' />
                        <span class='input-group-btn'>
                            <button type='submit'
                                class='bg-blue-500 text-sm hover:bg-blue-600 text-white font-bold py-2 px-4 rounded'>
                                Search
                            </button>
                        </span>
                    </div>
                </form>

            </div>

            <div class="font-semibold text-xl text-gray-800 leading-tight">
                <table class="min-w-full text-left text-sm font-light border border-black rounded tab ">
                    <thead class="border-b    font-extrabold dark:border-neutral-500">
                        <tr>
                            <th scope="col" class="px-6 py-4 !capitalize">#</th>
                            @foreach ($headings as $heading)
                                <th scope="col" class="px-6 py-4 !whitespace-nowrap     !capitalize "
                                    style="text-transform:capitalize">
                                    {{ $heading }} </th>
                            @endforeach



                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($message))

                            <tr class='text-4xl text-center mx-auto w-full row-span-full'>
                                <td colspan='8'>
                                    {{ $message }}</td>
                            </tr>
                        @else
                            @foreach ($employees as $employee)
                                <tr class="border-b dark:border-neutral-500">
                                    <td class="whitespace-nowrap px-6 py-4 font-medium">
                                        {{ $employee->id }}</td>
                                    <td class="!whitespace-nowrap px-6 py-4 font-bold capitalize"
                                        style="white-space: nowrap;">{{ $employee->name }}</td>
                                    <td class="!whitespace-nowrap px-6 py-4 font-bold capitalize"
                                        style="white-space: nowrap;">{{ $employee->contact }}</td>
                                    <td class="!whitespace-nowrap px-6 py-4 font-bold capitalize"
                                        style="white-space: nowrap;">{{ $employee->employee_id }}</td>
                                    <td class="!whitespace-nowrap px-6 py-4 font-bold capitalize"
                                        style="white-space: nowrap;">{{ $employee->department }}
                                    </td>
                                    <td class="!whitespace-nowrap px-6 py-4 font-bold capitalize truncate "
                                        style="white-space: ;max-width:170px">{{ $employee->position }}
                                    </td>
                                    <td class="!whitespace-nowrap px-6 py-4 font-bold capitalize"
                                        style="white-space: nowrap;">${{ $employee->current_salary }}
                                    </td>


                                </tr>
                            @endforeach
                        @endif



                    </tbody>
                </table>
                <div class='p-2 px-12'>
                    {{ $employees->links() }}
                </div>

            </div>
        </x-slot>
    </x-app-layout>

</body>

</html>
