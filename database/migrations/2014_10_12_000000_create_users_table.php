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
            $table->string('name')->unique;
            $table->unsignedinteger('acc_id')->unique;
            $table->string('phone_number');
            $table->string('faculty_number')->nullable();
            $table->string('home_number')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_admin');
            $table->boolean('is_super_admin');
            $table->string('password');
            $table->string('relation')->nullable();
            $table->text('note')->nullable();
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
