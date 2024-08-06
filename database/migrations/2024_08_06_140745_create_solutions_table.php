<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolutionsTable extends Migration
{
    public function up()
    {
        Schema::create('solutions', function (Blueprint $table) {
            $table->id();
            $table->string('h')->nullable();
            $table->string('i')->nullable();
            $table->string('e')->nullable();
            $table->string('r')->nullable();
            $table->string('g')->nullable();
            $table->string('b')->nullable();
            $table->string('t')->nullable();
            $table->string('s')->nullable();
            $table->string('n')->nullable();
            $table->string('u')->nullable();
            $table->integer('iterations')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('solutions');
    }
}