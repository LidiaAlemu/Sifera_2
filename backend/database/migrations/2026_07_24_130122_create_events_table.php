<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('event_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('location');
            $table->string('image_url')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->integer('max_participants');
            $table->string('status')->default('Upcoming'); // Upcoming, Ongoing, Completed, Cancelled
            $table->boolean('hidden')->default(false);
            $table->foreignId('created_by_id')->constrained('users');
            $table->timestamps();
            
            $table->index('event_date');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
