<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_item_id')->constrained('inventory_items');
            $table->integer('quantity_change');
            $table->string('movement_type'); // Sale, Restock, Waste, Adjustment
            $table->string('reference_type')->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamp('recorded_at')->useCurrent();
            $table->timestamps();
            
            $table->index('inventory_item_id');
            $table->index('movement_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_logs');
    }
};
