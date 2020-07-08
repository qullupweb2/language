<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('room_id');
            $table->integer('user_id');
            $table->string('status');
            $table->timestamp('date_start');
            $table->timestamp('date_end');
            $table->string('price');
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
        Schema::dropIfExists('room_items');
    }
}
