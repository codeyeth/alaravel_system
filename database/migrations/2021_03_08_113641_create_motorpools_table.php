<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotorpoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('motorpools', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id');
            $table->string('request_id');
            $table->string('emp_name');
            $table->string('destination');
            $table->string('date');
            $table->string('time');
            $table->string('purpose');
            $table->string('division_chief');
            $table->string('signature_file')->nullable();
            //change is_approved to integer for status 0 for no action 1 for approved and 2 for disapproved
            $table->integer('is_approved')->nullable()->default(0);
            $table->string('is_approved_at')->nullable();
            $table->string('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('motorpools');
    }
}
