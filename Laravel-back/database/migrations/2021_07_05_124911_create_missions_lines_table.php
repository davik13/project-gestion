<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionsLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions_lines', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->uuid('mission_id');
            $table->foreign('mission_id')->references('id')->on('missions');
            $table->string('title');
            $table->integer('quantity');
            $table->integer('price');
            $table->string('unity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions_lines');
    }
}
