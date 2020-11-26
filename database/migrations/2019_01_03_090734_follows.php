<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Follows extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->integer('user_1');
            $table->integer('user_2');
            $table->timestamps();
            //$table->foreign('user_1')->references('id')->on('users')->onDelete('cascade');
            //$table->foreign('user_2')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
