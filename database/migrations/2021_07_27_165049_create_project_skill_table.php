<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectSkillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_skill', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('skill_id')->nullable();
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')
                ->onUpdate('cascade')
                ->onDelete('set null');
//            $table->foreign('skill_id')->references('id')->on('skills');
////                ->onUpdate('cascade')
////                ->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_skill');
    }
}
