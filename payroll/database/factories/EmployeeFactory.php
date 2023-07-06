<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $employmentType = array('FULL_TIME', 'PART_TIME', 'CONTRACT');
        $randomKey = array_rand($employmentType);
        $randomEmploymentType = $employmentType[$randomKey];

        $departments = Department::all();

        $department = $departments[3]->name;
        $department_id = $departments[3]->id;

        $positions = Position::all();

       // $position = $positions[0]->name;
        $position_id = $positions[0]->id;

        $employee_id= substr($this->faker->year(),-2).'0'.$department_id.'0'.$position_id.'0'.random_int(10,25);

        return [
            //
            'name' => $this->faker->name(),
            'contact' => $this->faker->phoneNumber(),
            'employee_id' => $employee_id,
            'employment_type' => $randomEmploymentType,
            'salary_type' => ['Fixed', 'Rate_per_hour'][random_int(0, 1)],
            'email' => $this->faker->companyEmail(),
            'position' => $this->faker->jobTitle(),
            'position_id' => $this->faker->numberBetween(0, 2),
            'department' => $department,
           'department_id' => $department_id,
            'current_salary' => 12000,
            'year_joined' => $this->faker->year()


        ];
    }
}
