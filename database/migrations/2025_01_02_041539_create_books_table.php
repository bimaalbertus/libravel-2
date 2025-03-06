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
        Schema::create('books', function (Blueprint $table) {
            $table->string('id')->primary()->unique();
            $table->string('title')->nullable();
            $table->string('slug')->unique();
            $table->text('synopsis')->nullable();
            $table->string('language')->nullable();
            $table->string('image_path')->nullable();
            $table->integer('page_count')->nullable();
            $table->date('release_date')->nullable();
            $table->boolean('is_fiction')->nullable()->default(0);
            $table->boolean('is_teachers_book')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
