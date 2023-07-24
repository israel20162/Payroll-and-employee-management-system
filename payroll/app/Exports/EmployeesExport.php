<?php

namespace App\Exports;

use App\Models\Employee;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $employees = Employee::select(
            'name',
            'contact',
            'employee_id',
            'email',
            'position',
            'department',
            'current_salary',
            'year_joined',
            'gender',
            'account_number',
            'bank_name',
        )->get();


        return $employees;
    }
    public function headings(): array
    {
        $headers = Schema::getColumnListing('employees');
        $header = array_diff($headers, ['id', 'updated_at', 'created_at', 'employment_type', 'remember_token', 'password', 'department_id', 'position_id', 'salary_type', 'image']);

        return $header;
        // add more column names here as per your table structure

    }
}
