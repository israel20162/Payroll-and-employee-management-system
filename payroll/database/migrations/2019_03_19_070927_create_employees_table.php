<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('contact');
            $table->string('employee_id')->unique();
            $table->enum('employment_type', ['FULL_TIME', 'PART_TIME', 'CONTRACT']);
            $table->enum('salary_type', ['FIXED', 'RATE_PER_HOUR'])->default('Fixed');
            $table->string('email')->unique();
            $table->string('position');
            $table->string('department');
            $table->string('department_id');
            $table->string('position_id');
            $table->integer('current_salary');
            $table->string('year_joined');
            $table->string('image')->nullable();
            $table->string('gender');


            $table->timestamps();
        });
        // Schema::create('employees',function(Blueprint $table){

        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
