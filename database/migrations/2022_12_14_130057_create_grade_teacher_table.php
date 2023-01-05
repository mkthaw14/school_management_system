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
        Schema::create('grade_teacher', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("grade_id");
            $table->unsignedBigInteger("teacher_id");
            $table->foreign("grade_id")->references("id")->on("grades");
            $table->foreign("teacher_id")->references("id")->on("teachers");
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
        Schema::dropIfExists('grade_teacher');
    }
};
