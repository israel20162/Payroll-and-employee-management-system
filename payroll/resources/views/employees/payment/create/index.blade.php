<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Mata Tags -->
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Payment</title>
</head>

<body>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Payment') }}
            </h2>
        </x-slot>



        <x-slot name='slot'>
            <div class="container mx-auto px-4 py-5">
                <h1 class="text-3xl font-bold mb-4">
                    Employee List
                </h1>
                <a href=""
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 ">Generate payslips
                    for all</a>

                <table class='table-auto w-full bg-white'>
                    <thead>
                        <tr class="border-t rounded">
                            <th class="px-4 py-2 capitalize">11</th>
                            <th class="px-4 py-2 capitalize">1</th>
                            <th class="px-4 py-2 capitalize">1</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td scope='col' class="border px-4 py-2">{{$employee->name}}</td>
                                <td scope='col' class="border px-4 py-2">{{$employee->current_salary}}</td>
                                <td scope='col' class="border px-4 py-2">{{$employee->name}}</td>
                                <td scope='col' class="border"><a href="{{route('employees.payment.create',['id'=>$employee->id,'employee'=>$employee->name])}}">Generate Payslip</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>


    </x-app-layout>

</body>

</html>
