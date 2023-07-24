<html lang="en">
<x-employee-layout>
    <x-slot name='slot'>

        <body class="">
            <div class="container mx-auto p-8">
                <h1 class="text-3xl font-bold mb-4">Pay History</h1>

                <!-- Replace $payHistory with the actual array of pay history data from your controller -->
                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Payment Date
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tax
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Bonus
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Net Pay
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                                <!-- Add more columns as needed, e.g., Deductions, Net Pay, etc. -->
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($payHistory as $payment)
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
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $payment['payment_date'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">${{ $payment['amount'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">%{{ $payment['tax'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">${{ $payment['bonus'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">${{ $payment['net_pay'] }}</td>
                                    <td
                                        class="px-6 py-4 font-extrabold  whitespace-nowrap"style='color:{{ $status }}'>
                                        {{ $payment['status'] }}</td>
                                    <td
                                        class="px-6 py-4 flex gap-1 items-center text-center justify-center font-extrabold  whitespace-nowrap">
                                        <a href='/employee/payments/history/{{ $payment->id }}'> <button
                                                class="btn rounded p-2 btn-block btn-outline-dark bg-blue-500">
                                                view</button></a>
                                        <div class="flex justify-end ">
                                            <a class="rounded btn-block p-2 bg-blue-500"
                                                href="{{ route('employee.pdf', ['id' => $payment->id, 'download' => 'pdf']) }}">Export
                                                to PDF</a>
                                        </div>

                                    </td>
                                    <!-- Add more columns as needed, e.g., Deductions, Net Pay, etc. -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </body>




    </x-slot>
</x-employee-layout>

</html>
