<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
        // リアルタイムチャット機能
            $table->id();
            $table->timestamps();
            $table->text('message');
            $table->unsignedBigInteger('message_room_id');
            $table->foreign('message_room_id')->references('id')->on('message_rooms')->onDelete('cascade');
            $table->unsignedBigInteger('message_user_id');
            $table->foreign('message_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}

