<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('username')->unique;
            $table->string('f_name');
            $table->string('l_name');
            $table->unsignedinteger('acc_id')->unique;
            $table->string('phone_number');
            $table->string('faculty_number')->nullable();
            $table->string('home_number')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_admin')->default('0');
            $table->boolean('is_super_admin')->default('0');
            $table->string('password');
            $table->string('relation')->nullable();
            $table->text('note')->nullable();
            $table->text('user_note')->nullable();
            $table->BigInteger('instalment')->nullable();
            $table->string('period')->nullable();
            $table->string('loan_row')->nullable();
            $table->string('cheque')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->BigInteger('instalment_force')->nullable();
            $table->string('period_force')->nullable();
            $table->string('loan_row_force')->nullable();
            $table->string('cheque_force')->nullable();
            $table->string('start_date_force')->nullable();
            $table->string('end_date_force')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
