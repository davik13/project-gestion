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
            $table->uuid('id')->primary();
            $table->uuid( 'mission_id')->nullable();
            $table->string( 'title')->nullable();
            $table->integer( 'quantity')->nullable();
            $table->integer( 'price')->nullable();
            $table->string( 'unity')->nullable();
            $table->foreign('mission_id')->references('id')->on('missions');
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
        Schema::dropIfExists('missions_lines');
    }
}
