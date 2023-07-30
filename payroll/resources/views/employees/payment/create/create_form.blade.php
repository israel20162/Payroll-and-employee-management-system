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
            <div class="container mx-auto p-4">
                <h1 class="text-3xl font-bold mb-4">
                    Create Employee Payslip
                </h1>

                <form id="payslipForm" action={{ route('employees.payments.store', ['id' => $employee->id,'action'=>'generate']) }} method="post"
                    class="max-w-screen-lg grid group-hover:cursor-pointer capitalize grid-cols-2 gap-x-4  mx-auto"
                    style="column-gap: 3rem" >

                    @csrf
                    @method('POST')
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2 ">Employee Name:</label>
                        <input type="text" id='name' name="name"
                            class="w-full border capitalize rounded py-2 px-3" value="{{ $employee->name }}">
                    </div>
                    <div class="mb-4">
                        <label for="salary" class="block text-gray-700 font-bold text-sm mb-2 ">Salary:</label>
                        <input type="text" disabled id='salary' name="salary"
                            class="w-full border rounded py-2 px-3" value="{{ $employee->current_salary }}">
                    </div>
                    <div class="mb-4">
                        <label for='department'class="block text-gray-700 text-sm font-bold mb-2 ">Department:</label>
                        <input type="text" id='department' name='department' disabled
                            class="w-full capitalize border rounded py-2 px-3" value="{{ $employee->department }}">
                    </div>
                    <div class="mb-4">
                        <label for='position'class="block text-gray-700 text-sm font-bold mb-2 ">Position:</label>
                        <input type="text" id='position' name='position' disabled
                            class="w-full capitalize border rounded py-2 px-3" value="{{ $employee->position }}">
                    </div>
                    <div class="mb-4">
                        <label for='start_date'class="block text-gray-700 text-sm font-bold mb-2 ">Start Date:</label>
                        <input type="date" name="start_date" id="start_date"
                            class="w-full capitalize border rounded py-2 px-3" value="{{ date('Y-m-01') }}">
                    </div>
                    <div class="mb-4">
                        <label for='end_date'class="block text-gray-700 text-sm font-bold mb-2 ">End Date:</label>
                        <input type="date" name="end_date" id="end_date"
                            class="w-full capitalize border rounded py-2 px-3" value="{{ date('Y-m-t') }}">
                    </div>
                    <div class="mb-4">
                        <label for='tax'class="block text-gray-700 text-sm font-bold mb-2 ">Tax Deductions
                            (%)</label>
                        <input type="number" id="tax" name="tax"
                            class="w-full shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-md "
                            step="0.1" value="0.00" min="0" maxlength="100" max="100">
                    </div>
                    <div class="mb-4">
                        <label for='end_date'class="block text-gray-700 text-sm font-bold mb-2 ">Bonus Amount</label>
                        <input type="number" id="bonus" name="bonus"
                            class="w-full shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-md "
                            step="" value="0.00">
                    </div>
                    <div class="flex items-center justify-between">
                        <button type="button" id='calculateButton'
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ">
                            Generate Payslip
                        </button>
                    </div>

                </form>


            </div>



            {{-- modal --}}
            <div class="fixed z-10 inset-0 overflow-y-hidden hidden" id="modal">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-500 opacity-10" id="modal-bg" style="opacity: 50%">
                        </div>
                    </div>
                    <div
                        class="bg-white mx-auto mt-[25vh]  rounded-lg px-4 pt-5 pb-4 overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:p-6">
                        <div>
                            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
                                <svg class="h-6 w-6 text-green-600" xmlns='httpL//www.w3.org/2000/svg' fill='none'
                                    viewBox='0 0 24 24 ' stroke='currentColor' aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="mt-3 text-center sm:mt-5">
                                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Payslip Calculated
                                </h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500" id="modal-content">
                                        The net pay is: <span id="netPay"></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 sm:mt-6">
                            <button type="button" id="generateButton"
                                class="inline-flex justify-center w-full rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm">
                                Generate Payslip
                            </button>
                        </div>

                    </div>
                </div>
            </div>

        </x-slot>
        @push('scripts')

            <script>
                document.getElementById('calculateButton').addEventListener('click', function() {

                    const salary = parseFloat(document.getElementById('salary').value);
                    const tax = parseFloat(document.getElementById('tax').value);
                    const bonus = parseFloat(document.getElementById('bonus').value);

                    const netPay = salary + bonus - (salary * (tax / 100));

                    document.getElementById('netPay').textContent = netPay.toLocaleString();

                    document.getElementById('modal').classList.remove('hidden');
                });

                document.getElementById('generateButton').addEventListener('click',function(){
                    document.getElementById('payslipForm').submit();
                })


                document.getElementById('modal-bg').addEventListener('click', function() {
                    document.getElementById('modal').classList.add('hidden');
                })
                document.getElementById('bonus').addEventListener('input', function(e) {
                    e.target.value.toLocaleString();
                });
            </script>
        @endpush
    </x-app-layout>


</body>

</html>
