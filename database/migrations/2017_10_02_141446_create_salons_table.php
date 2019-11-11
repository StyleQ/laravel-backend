<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

          Schema::create('salons', function (Blueprint $table) {
              $table->increments('id');
              $table->string('name');
              $table->string('logo')->nullable();
              $table->string('address1')->nullable();
              $table->string('address2')->nullable();
              $table->string('city')->nullable();
              $table->string('state')->nullable();
              $table->string('zip')->nullable();
              $table->string('phone')->nullable();
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
        Schema::dropIfExists('salons');
    }
}
