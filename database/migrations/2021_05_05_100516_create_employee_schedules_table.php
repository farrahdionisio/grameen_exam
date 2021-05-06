<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeSchedulesTable extends Migration
{

    public function up()
    {
        Schema::create('employee_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('employee_id')
                                          ->on('employees')
                                          ->onDelete('cascade');
            $table->string('title', 256);
            $table->text('details');
            $table->date('schedule_date');
            $table->time('schedule_start_time');
            $table->time('schedule_end_time');
            $table->boolean('is_active');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')
                                          ->on('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('employee_schedules');
    }
}
