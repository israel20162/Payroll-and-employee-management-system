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

                <h1>Employee Payments - {{ $month }} {{$selectedYear}}</h1>
                @php
                    $selectedMonth = $month;
                @endphp

                <!-- Month Selection -->
                <div class="flex justify-between items-center w-full">
                    <form action={{ route('employees.payments') }} method="get">
                        <label for="month">Select Month:</label>

                        <select name="month">
                            <option value="01" @if ($month === 'January') selected @endif>January</option>
                            <option value="02" @if ($month === 'February') selected @endif>February</option>
                            <option value="03" @if ($month === 'March') selected @endif>March</option>
                            <option value="04" @if ($month === 'April') selected @endif>April</option>
                            <option value="05" @if ($month === 'May') selected @endif>May</option>
                            <option value="06" @if ($month === 'June') selected @endif>June</option>
                            <option value="07" @if ($month === 'July') selected @endif>July</option>
                            <option value="08" @if ($month === 'August') selected @endif>August</option>
                            <option value="09" @if ($month === 'September') selected @endif>September</option>
                            <option value="10" @if ($month === 'October') selected @endif>October</option>
                            <option value="11" @if ($month === 'November') selected @endif>November</option>
                            <option value="12" @if ($month === 'December') selected @endif>December</option>
                        </select>

                        <select name="year" id="year" >
                            @for ($year = date('Y'); $year >= 2000; $year--)
                                <option value="{{ $year }}" selected >
                                    {{ $year }}</option>
                            @endfor
                        </select>

                        @push('scripts')
                            <script>
                               var year = document.getElementById('year')
                                console.log(year.value)

                            </script>
                        @endpush

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
                                Amount</th>
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
                            @php
                                $status = '';
                            @endphp
                            @php
                                if ($payment->status === 'PENDING') {
                                    $status = 'orange';
                                } elseif ($payment->status === 'PAID') {
                                    $status = 'green';
                                } else {
                                    $status = 'red';
                                }
                            @endphp
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap capitalize">{{ $payment->employee->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap capitalize">
                                    ${{ number_format($payment->net_pay, 2) }}</td>
                                <td style="color: {{ $status }}" class="px-6 py-4 whitespace-nowrap capitalize">
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
