<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RoomUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('room_users', function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->increments('id');
        $table->unsignedInteger('room_id');
        $table->string('user_id');
        $table
          ->foreign('room_id')
          ->references('id')
          ->on('rooms')
          ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('room_users');
    }
}
