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
          $table->increments('id');
          $table->string('first_name');
          $table->string('last_name');
          $table->integer('company_id')->unsigned();
          $table->foreign('company_id')->references('id')->on('Companies')->onDelete('restrict');
          $table->string('email')->nullable();
          $table->string('phone')->nullable();
          $table->timestamp('created_at')->nullable();
          $table->timestamp('updated_at')->nullable();
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
