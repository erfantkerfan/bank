<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->text('text');
            $table->timestamps();
        });
        DB::table('configs')->insert(
            array(
                [
                    'type' => 'top_h',
                    'text' => 'hi'
                ],
                [
                    'type' => 'down_h',
                    'text' => 'bye'
                ]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configs');
    }
}
