<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePaymentsHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('payments_history', function (Blueprint $table) {
            $table->string('month');
            $table->string('year');
            $table->date('start_date')->nullable();
            $table->string('end_date');
            $table->date('generated_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropColumns('payments_history',['end_date','start_date','year','month']);
    }
}
