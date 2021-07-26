<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
<<<<<<< HEAD
<<<<<<< HEAD
            $table->string('password');
            $table->string('paymentMethode')->nullable();
            $table->boolean('visibility')->default(true);
            $table->string('status')->default('active');
            $table->string('role')->default('client');
=======
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
>>>>>>> 4bd199ac2787eaadf46a1e77d0a8787a3f6148e2
=======
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
>>>>>>> 4bd199ac2787eaadf46a1e77d0a8787a3f6148e2
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
