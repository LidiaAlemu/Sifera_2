<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('isbn');
            $table->string('title');
            $table->string('author');
            $table->foreignId('category_id')->constrained('book_categories');
            $table->integer('publication_year')->nullable();
            $table->string('language')->default('English');
            $table->string('edition')->nullable();
            $table->text('description')->nullable();
            $table->string('shelf_location')->nullable();
            $table->string('cover_image')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('title');
            $table->index('author');
            $table->index('isbn');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
