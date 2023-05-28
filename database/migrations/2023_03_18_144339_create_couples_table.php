<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('couples', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->integer('male_gid')->unsigned();
            $table->foreign('male_gid')->references('id')->on('guests')->onDelete('cascade');
            $table->boolean('male_invite')->default(false);
            $table->integer('female_gid')->unsigned();
            $table->foreign('female_gid')->references('id')->on('guests')->onDelete('cascade');
            $table->boolean('female_invite')->default(false);
            $table->boolean('is_matched')->default(false);
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
        Schema::dropIfExists('couples');
    }
};
