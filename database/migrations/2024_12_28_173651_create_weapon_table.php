<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('weapons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); 
            $table->integer('price');
            $table->string('difficulty'); 
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        
        Schema::create('weapon_favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('weapon_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->unique(['user_id', 'weapon_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('weapon_favorites');
        Schema::dropIfExists('weapons');
    }
};