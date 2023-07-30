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
                style="margin-bottom: 16px"
                    class="bg-blue-500 m-2 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 ">Generate payslips
                    for all</a>

                <table class='table-auto w-full bg-white mt-4'>
                    <thead>
                        <tr class="border-t rounded">
                            <th class="px-4 py-2 capitalize">Name</th>
                            <th class="px-4 py-2 capitalize">Salary</th>
                            {{-- <th class="px-4 py-2 capitalize">1</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($employees as $employee)
                            <tr>
                                <td scope='col' class="border px-4 py-2">{{$employee->name}}</td>
                                <td scope='col' class="border px-4 py-2">{{number_format($employee->current_salary,2)}}</td>
                                {{-- <td scope='col' class="border px-4 py-2">{{$employee->name}}</td> --}}
                                <td scope='col' class="border"><a class="m-1 px-4 py-2 text-sm text-white rounded text-center bg-green-500" href="{{route('employees.payment.create',['id'=>$employee->id,'employee'=>$employee->name])}}">Generate Payslip</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-slot>


    </x-app-layout>

</body>

</html>
