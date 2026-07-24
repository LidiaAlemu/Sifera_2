<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book_copies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('books');
            $table->string('barcode')->unique();
            $table->string('condition')->default('New'); // New, Good, Fair, Poor
            $table->string('status')->default('Available'); // Available, Borrowed, Damaged, Lost
            $table->timestamps();
            
            $table->index('barcode');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book_copies');
    }
};
