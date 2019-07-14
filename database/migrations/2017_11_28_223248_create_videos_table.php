<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider')->default('youtube');
            $table->string('eid')->nullable();
            $table->string('channel_eid')->nullable();
            $table->string('ytid')->unique();
            $table->unsignedInteger('channel_id');

            $table->string('name');
            $table->text('description');
            $table->dateTime('uploaded_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
