<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToMetachannelsVideosChannelMetachannel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('metachannels', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');
        });

        Schema::table('channel_metachannel', function (Blueprint $table) {
            $table->foreign('channel_id')->references('id')->on('channels')->onDelete('cascade');
            $table->foreign('metachannel_id')->references('id')->on('metachannels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('metachannels', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::table('videos', function (Blueprint $table) {
            $table->dropForeign(['channel_id']);
        });

        Schema::table('channel_metachannel', function (Blueprint $table) {
            $table->dropForeign(['channel_id']);
            $table->dropForeign(['metachannel_id']);
        });
    }
}
