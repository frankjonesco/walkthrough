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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('hex', 11);
            $table->foreignId('user_id');
            $table->string('title')->nullable();
            $table->string('caption')->nullable();
            $table->longText('body')->nullable();
            $table->string('image')->nullable();
            $table->integer('views')->nullable();
            $table->timestamps();
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
