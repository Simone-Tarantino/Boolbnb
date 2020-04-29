<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->integer('room_number');
            $table->integer('bed');
            $table->integer('bathroom');
            $table->double('mq', 5, 2);
            $table->string('address', 255);
            $table->text('img_path');
            $table->boolean('status');
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
        Schema::dropIfExists('houses');
    }
}
