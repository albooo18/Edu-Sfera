<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('body');
            $table->unsignedInteger('views')->default(0);
            $table->unsignedInteger('replies')->default(0);
            $table->integer('votes')->default(0);
            $table->unsignedInteger('best_replie_id')->nullable();
            $table->unsignedBigInteger('userId'); // Only this line is necessary.
            $table->timestamps();
        
            $table->foreign('userId')->references('id')->on('users')->cascadeOnDelete();
        });
        

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
