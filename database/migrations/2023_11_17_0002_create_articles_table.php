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
            $table->foreignId('category_id')->nullable();
            $table->string('title')->nullable();
            $table->string('slug');
            $table->string('caption')->nullable();
            $table->longText('body')->nullable();
            $table->string('tags')->nullable();
            $table->string('image')->nullable();
            $table->string('image_caption')->nullable();
            $table->string('image_copyright')->nullable();
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
