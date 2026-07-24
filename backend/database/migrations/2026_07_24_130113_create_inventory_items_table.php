<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('current_stock')->default(0);
            $table->integer('minimum_stock')->default(10);
            $table->integer('reorder_level')->default(20);
            $table->string('unit')->default('pcs');
            $table->timestamps();
            
            $table->index('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventory_items');
    }
};
