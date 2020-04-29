<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHouseSponsorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('house_sponsor', function (Blueprint $table) {
            

            $table->unsignedBigInteger('sponsor_id'); 
            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('cascade')->onUpdate('cascade'); 
            $table->unsignedBigInteger('house_id'); 
            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('house_sponsor');
    }
}
