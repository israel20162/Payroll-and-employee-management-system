<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments_history', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->date('payment_date');
            $table->decimal('amount', 15, 2);
            $table->decimal('tax', 12, 2);
            $table->decimal('bonus', 12, 2);
            $table->decimal('net_pay',12,2);
            $table->decimal('deductions',12,2)->default(0.00);
            $table->enum('status',['PENDING','UNPAID','PAID']);

            $table->timestamps();

            // Define foreign key constraint for employee_id
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    { // Drop the foreign key constraint first to avoid issues when rolling back
        Schema::table('payments_history', function (Blueprint $table) {
            $table->dropForeign(['employee_id']);
        });
        Schema::dropIfExists('payments_histories');
    }
}
