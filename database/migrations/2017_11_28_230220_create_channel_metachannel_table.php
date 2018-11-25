<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelMetachannelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_metachannel', function (Blueprint $table) {
            $table->string('provider')->default('youtube');
            $table->string('channel_eid')->nullable();
            $table->unsignedInteger('channel_id');
            $table->unsignedInteger('metachannel_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channel_metachannel');
    }
}
