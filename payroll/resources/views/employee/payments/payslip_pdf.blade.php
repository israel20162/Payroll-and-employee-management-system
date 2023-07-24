<style>
    .shadow {
        --tw-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
        --tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);
        box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
    }

    @media (min-width: 640px) {
        .sm\:rounded-lg {
            border-radius: 0.5rem
                /* 8px */
            ;
        }
    }

    .text-lg {
        font-size: 1.125rem
            /* 18px */
        ;
        line-height: 1.75rem
            /* 28px */
        ;
    }

    ;

    .gap-4 {
        gap: 1rem
            /* 16px */
        ;
    }
</style>


<div class=" shadow  sm:rounded-lg" style="background-color: white ; overflow:hidden;">
    <div class=" sm:px-20 bg-white border-b border-gray-200"
        style="padding: 24px;background-color:white;border-bottom-width: 1px;">
        <div class="flex justify-between" style="display: flex; justify-content: space-between;">
            <div>


                <h2 class=" font-semibold   text-2xl mb-2"
                    style=" font-weight: 600;  line-height: 2rem; font-size: 1.5rem; margin-bottom: 0.5rem">Employee
                    Payslip</h2>
                <p class="text-gray-600"
                    style="  --tw-text-opacity: 1;
    color: rgb(75 85 99 / var(--tw-text-opacity));">Pay Period:
                    {{ date('F j, Y', strtotime($payment['start_date'])) }} -
                    {{ date('F j, Y', strtotime($payment['end_date'])) }}</p>
            </div>
            <img src="company-logo.png" alt="Company Logo" class="w-16 h-16">
        </div>
    </div>
    <div class="grid capitalize grid-cols-2 gap-4"
        style=" display: grid;  gap: 1rem; text-transform: capitalize; grid-template-columns: repeat(2, minmax(0, 1fr));">
        <div>
            <h3 class="text-lg font-semibold mb-2" style="font-weight: 600; margin-bottom: 0.5rem">Employee Information
            </h3>
            <p><strong>Name:</strong> {{ $payment['employee']['name'] }}</p>
            <p><strong>Employee ID:</strong>{{ $payment['employee']['employee_id'] }}</p>
            <p><strong>Department:</strong>{{ $payment['employee']['department'] }}</p>
            <!-- Add more employee information here -->
        </div>
        <div>
            <h3 class="text-lg font-semibold mb-2" style="font-weight: 600; margin-bottom: 0.5rem">Earnings</h3>
            <p><strong>Basic Salary:</strong> ${{ number_format($payment['employee']['current_salary'], 2) }}</p>
            <p><strong>Allowances:</strong> ${{ number_format(0, 2) }}</p>
            <p><strong>Bonuses:</strong>${{ number_format($payment['bonus'], 2) }}</p>
            <!-- Add more earning components here -->
        </div>
    </div>
    <div class="grid grid-cols-2 gap-4 mt-4"
        style=" display: grid; gap: 1rem;  margin-top: 1rem; grid-template-columns: repeat(2, minmax(0, 1fr));">
        <div class="">
            <h3 class="text-lg font-semibold mb-2" style="font-weight: 600; margin-bottom: 0.5rem">Deductions</h3>
            <p><strong>Tax Deductions:</strong> ${{ number_format(($payment['tax'] / 100) * $payment['amount'], 2) }}
            </p>
            <p><strong>Social Security:</strong> ${{ 0.0 }}</p>
            <p><strong>Health Insurance:</strong> $0.00</p>
            <!-- Add more deduction components here -->
        </div>
        <div>
            <h3  style="font-weight: 600; margin-bottom: 0.5rem">Net Pay</h3>
            <p><strong>Total Deductions:</strong> ${{ number_format(($payment['tax'] / 100) * $payment['amount'], 2) }}
            </p>
            <p><strong>Net Salary:</strong>${{ number_format($payment['net_pay'], 2) }}</p>
        </div>
        <div>
            @php
                $status = '';
            @endphp
            @php
                if ($payment['status'] === 'PENDING') {
                    $status = 'orange';
                } elseif ($payment['status'] === 'PAID') {
                    $status = 'green';
                } else {
                    $status = 'red';
                }
            @endphp
            <h3 class="text-lg font-semibold my-2">Status</h3>
            <p style="color:{{ $status }}"><strong>{{ $payment['status'] }}</strong> </p>

        </div>
    </div>
</div>
</div>
