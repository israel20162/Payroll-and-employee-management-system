<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Mata Tags -->
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Payments</title>
</head>

<body>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Payments') }}
            </h2>
        </x-slot>

        <x-slot name="slot">
            <div class="container">
                <h1>Employee Payments - {{ $month }}</h1>
                @php
                    $selectedMonth = date('F', mktime(0, 0, 0, date('m')));
                @endphp
                <!-- Month Selection -->
                <div class="flex justify-between items-center w-full">
                    <form action="" method="get">
                        <label for="month">Select Month:</label>
                        <select name="month" id="month">
                            <option value="01" @if ($selectedMonth === '01') selected @endif>{{ date('m') }}
                            </option>
                            <option value="02" @if ($selectedMonth === '02') selected @endif>February</option>
                            <!-- Add options for other months -->
                        </select>
                        <button type="submit">Go</button>
                    </form>
                    <a href="{{ route('employees.payments.create') }}">
                        <button class="block rounded p-2 bg-blue-600">
                            create new
                        </button>
                    </a>

                </div>


                <!-- Employees' Payments Table -->
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Salary</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($payments as $payment)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $payment->employee->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap capitalize">
                                    ${{ number_format($payment->net_pay, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap capitalize">
                                    {{ $payment->status }}</td>
                                <td class="px-6 py-4 whitespace-nowrap capitalize flex gap-1">
                                    <a
                                        href="{{ route('employees.payment.view', ['id' => $payment->id]) }}"><button>view</button></a>
                                    <form
                                        action="{{ route('employees.payment.status', ['id' => $payment->id, 'action' => 'paid', 'month' => $selectedMonth]) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit">Change Status</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </x-slot>
    </x-app-layout>

</body>

</html>
