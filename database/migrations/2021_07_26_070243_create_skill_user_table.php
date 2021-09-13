<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skill_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('skill_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

//            $table->foreign('skill_id')->references('id')->on('skills')
//                ->onUpdate('cascade')
//                ->onDelete('set null');
//            $table->foreign('user_id')->references('id')->on('users')                ->onUpdate('cascade')
//                ->onUpdate('cascade')
//                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skill_user');
    }
}
