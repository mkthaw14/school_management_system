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
        Schema::create('subject_assignments', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("grade_id");
            $table->unsignedBigInteger("subject_id");
            $table->unsignedBigInteger("teacher_id");

            $table->foreign("grade_id")->references("id")->on("grades");
            $table->foreign("subject_id")->references("id")->on("subjects");
            $table->foreign("teacher_id")->references("id")->on("teachers");
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
        Schema::dropIfExists('subjectassignments');
    }
};
