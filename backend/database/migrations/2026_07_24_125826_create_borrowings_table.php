<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('copy_id')->constrained('book_copies');
            $table->timestamp('borrowed_at')->useCurrent();
            $table->date('due_date');
            $table->time('due_time')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->foreignId('returned_by')->nullable()->constrained('users');
            $table->foreignId('borrowed_by')->constrained('users');
            $table->decimal('amount_charged', 10, 2)->default(0);
            $table->string('status')->default('Active'); // Active, Returned, Overdue
            $table->timestamps();
            
            $table->index('user_id');
            $table->index('copy_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
