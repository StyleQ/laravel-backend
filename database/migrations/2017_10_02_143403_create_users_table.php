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
      Schema::create('roles', function (Blueprint $table) {
          $table->increments('id');
          $table->string('role')->unique();
          $table->timestamps();
      });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->integer('salon_id')->unsigned()->nullable();
            $table->foreign('salon_id')->references('id')->on('salons')->nullable();
            $table->string('first')->nullable();
            $table->string('last')->nullable();
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('roles')->insert(
          array(
          array(
            'id' => '1',
            'role' => 'admin'
          ),
          array(
            'id' => '2',
            'role' => 'owner'
          ),
          array(
            'id' => '3',
            'role' => 'independent'
          ),
          array(
            'id' => '4',
            'role' => 'stylist'
          )
        ));

      }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('roles');
    }
}
