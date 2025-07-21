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
            $table->id();
            $table->string('title');
            $table->string('author');
            $table->string('genre');
            $table->year('published_year');
            $table->string('isbn')->unique();
            $table->boolean('available')->default(true);
            $table->string('donor')->nullable();
            $table->string('donor_phone')->nullable();
            $table->string('usage_status')->nullable();
            $table->string('image_path')->nullable(); // book image or default image path
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
