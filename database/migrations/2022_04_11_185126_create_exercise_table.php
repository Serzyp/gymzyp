<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExerciseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercise', function (Blueprint $table) {
            $table->id();
            $table->foreignId('table_id');
            $table->foreign('table_id')->references('id')->on('table_exercises');
            $table->foreignId('day_id');
            $table->foreign('day_id')->references('id')->on('day');
            $table->text('content');
            $table->integer('sets');
            $table->string('reps');
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
        Schema::dropIfExists('exercise');
    }
}
