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
        Schema::create('stock', function (Blueprint $table) {
            $table->id('stock_id'); // Auto-incremented primary key
            $table->unsignedBigInteger('product_id');
            $table->integer('product_stock');
            
            // Define foreign key constraint
            $table->foreign('product_id')
                  ->references('product_id')
                  ->on('product')
                  ->onDelete('cascade'); // Cascade delete
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock');
    }
};
