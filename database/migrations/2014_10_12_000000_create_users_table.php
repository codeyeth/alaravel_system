<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->uuid('user_id')->unique();
            $table->string('fname');
            $table->string('mname')->nullable();
            $table->string('lname');
            $table->string('name');
            $table->string('email')->unique();
            
            
            $table->string('position');
            $table->string('division');
            $table->string('section');
            $table->string('user_role');

            $table->boolean('is_user_mgt')->nullable()->default(false);
            $table->timestamp('email_verified_at')->nullable();

            $table->string('password');
            $table->string('password_string');
            $table->boolean('is_pw_changed')->default(false);

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
