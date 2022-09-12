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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->unique();

            $table->string('image')->default('profile-picture/default.png');
            $table->string('title')->nullable();
            $table->string('description')->nullable();

            $table->foreignId('book1')->nullable();
            $table->foreignId('book2')->nullable();
            $table->foreignId('book3')->nullable();

            $table->boolean('public')->default(1);

            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profile');
    }
};
