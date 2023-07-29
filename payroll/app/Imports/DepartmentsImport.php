<?php

namespace App\Imports;

use App\Models\Department;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DepartmentsImport implements ToCollection, WithHeadingRow
{


    public function collection(Collection $rows)
    {
        // Collect all department name from the Excel file
        $departments = $rows->pluck('name')->toArray();

        // Query the database once for existing departments
        $existingDepartments = Department::whereIn('name', $departments)->pluck('name')->toArray();

        foreach ($rows as $row) {
            // If the department doesn't exist in the database, create a new user
            if (!in_array($row['name'], $existingDepartments)) {
                Department::create([
                    'name' => $row['name'],

                ]);
            }
        }
    }
}
