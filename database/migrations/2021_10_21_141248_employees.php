<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Employees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('Employees', function (Blueprint $table) {
          $table->increments('Id');
          $table->string('First_Name');
          $table->string('Last_Name');
          $table->integer('Companies_Id')->unsigned();
          $table->foreign('Companies_Id')->references('Id')->on('Companies')->onDelete('restrict');
          $table->string('Email')->nullable();
          $table->string('Phone')->nullable();;
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
