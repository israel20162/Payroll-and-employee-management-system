<?php

namespace Database\Seeders;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       //  \App\Models\User::factory(10)->create();
        //$departments = Department::factory(10)->create();
       $users = Employee::factory()->for(Position::factory()->create([
        'name'=>'manager',
        'fixed_salary'=>120000
       ]))->count(10)->create();
    }



}
