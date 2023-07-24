 <x-employee-layout>

     <x-slot name='slot'>
         <div class="bg-white shadow overflow-hidden sm:rounded-lg">
             <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                 <div class="flex justify-between">
                     <div>


                         <h2 class="text-2xl font-semibold mb-2">Employee Payslip</h2>
                         <p class="text-gray-600">Pay Period: {{ date('F j, Y', strtotime($payment->start_date)) }} -
                             {{ date('F j, Y', strtotime($payment->end_date)) }}</p>
                     </div>
                     <img src="company-logo.png" alt="Company Logo" class="w-16 h-16">
                 </div>
             </div>
             <div class="px-4 py-5 sm:p-6">
                 <div class="grid capitalize grid-cols-2 gap-4">
                     <div>
                         <h3 class="text-lg font-semibold mb-2">Employee Information</h3>
                         <p><strong>Name:</strong> {{ $payment->employee->name }}</p>
                         <p><strong>Employee ID:</strong>{{ $payment->employee->employee_id }}</p>
                         <p><strong>Department:</strong>{{ $payment->employee->department }}</p>
                         <!-- Add more employee information here -->
                     </div>
                     <div>
                         <h3 class="text-lg font-semibold mb-2">Earnings</h3>
                         <p><strong>Basic Salary:</strong> ${{ $payment->employee->current_salary }}</p>
                         <p><strong>Allowances:</strong> $0.00</p>
                         <p><strong>Bonuses:</strong>${{ $payment->bonus }}</p>
                         <!-- Add more earning components here -->
                     </div>
                 </div>
                 <div class="grid grid-cols-2 gap-4 mt-4">
                     <div class="">
                         <h3 class="text-lg font-semibold mb-2">Deductions</h3>
                         <p><strong>Tax Deductions:</strong> ${{ ($payment->tax / 100) * $payment->amount }}</p>
                         <p><strong>Social Security:</strong> ${{ 0.0 }}</p>
                         <p><strong>Health Insurance:</strong> $0.00</p>
                         <!-- Add more deduction components here -->
                     </div>
                     <div>
                         <h3 class="text-lg font-semibold my-2">Net Pay</h3>
                         <p><strong>Total Deductions:</strong> ${{$payment->deductions}}</p>
                         <p><strong>Net Salary:</strong>${{ $payment->net_pay }}</p>
                     </div>
                      <div>
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
                         <h3 class="text-lg font-semibold my-2">Status</h3>
                         <p style="color:{{$status}}"><strong>{{$payment->status}}</strong> </p>

                     </div>
                 </div>
             </div>
         </div>
     </x-slot>
 </x-employee-layout>
