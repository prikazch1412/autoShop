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
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('phone');
            $table->string('address')->nullable();
            $table->string('photo')->default('/img/no-image.png');
            $table->string('service_name')->nullable();
            $table->foreignId('city_id');
            $table->foreignId('user_role_id');
            $table->string('email')->unique();
            $table->text('description')->nullable();
            $table->string('password');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('city_id');
            $table->foreign('city_id')->references('id')->on('city');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->index('user_role_id');
            $table->foreign('user_role_id')->references('id')->on('user_roles');
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
