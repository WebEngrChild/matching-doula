<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefectures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->integer('sort_no');
        });

        Schema::create('message_rooms', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });

        Schema::create('primary_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('sort_no');

            $table->timestamps();
        });

        Schema::create('secondary_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('primary_category_id');
            $table->string('name');
            $table->integer('sort_no');
            $table->timestamps();
            $table->foreign('primary_category_id')->references('id')->on('primary_categories');
        });

        Schema::create('item_conditions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('sort_no');
            $table->timestamps();
        });

        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seller_id');
            $table->unsignedBigInteger('buyer_id')->nullable();
            $table->unsignedBigInteger('secondary_category_id');
            $table->unsignedBigInteger('item_condition_id');
            $table->string('name');
            $table->string('image_file_name');
            $table->text('description');
            $table->unsignedInteger('price');
            $table->string('state');
            $table->timestamp('bought_at')->nullable();
            $table->timestamps();
            $table->foreign('seller_id')->references('id')->on('users');
            $table->foreign('buyer_id')->references('id')->on('users');
            $table->foreign('secondary_category_id')->references('id')->on('secondary_categories');
            $table->foreign('item_condition_id')->references('id')->on('item_conditions');
            $table->string('zoom');
            $table->string('postage');

            // リアルタイムチャット機能
            $table->unsignedBigInteger('message_room_id')->nullable();
            $table->foreign('message_room_id')->references('id')->on('message_rooms');

            //エリア機能
            $table->unsignedBigInteger('prefecture_id')->nullable();
            $table->foreign('prefecture_id')->references('id')->on('prefectures');

            //通知機能
            $table->unsignedBigInteger('seller_read_id')->nullable();
            $table->foreign('seller_read_id')->references('id')->on('message_reads')->onDelete('cascade');
            $table->unsignedBigInteger('buyer_read_id')->nullable();
            $table->foreign('buyer_read_id')->references('id')->on('message_reads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
        Schema::dropIfExists('item_conditions');
        Schema::dropIfExists('secondary_categories');
        Schema::dropIfExists('primary_categories');
        Schema::dropIfExists('message_rooms');
        Schema::dropIfExists('prefectures');
    }
}
