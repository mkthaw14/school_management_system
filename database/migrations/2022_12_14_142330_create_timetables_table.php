<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\SoftDeletes;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timetables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("day_id");
            $table->unsignedBigInteger("time_id");
            $table->unsignedBigInteger("teacher_id");
            $table->unsignedBigInteger("section_id");
            $table->unsignedBigInteger("subject_id");

            $table->foreign("day_id")->references("id")->on("grades");
            $table->foreign("time_id")->references("id")->on("times");
            $table->foreign("teacher_id")->references("id")->on("teachers");
            $table->foreign("section_id")->references("id")->on("sections");
            $table->foreign("subject_id")->references("id")->on("subjects");
            $table->softDeletes();
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
        Schema::dropIfExists('timetables');
    }
};
