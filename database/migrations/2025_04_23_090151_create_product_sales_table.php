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
        Schema::create('product_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')
                  ->constrained('sales')
                  ->cascadeOnDelete()
                  ->index()
                  ->name('fk_product_sales_sale_id');
            $table->foreignId('product_id')
                  ->constrained('products')
                  ->cascadeOnDelete()
                  ->index()
                  ->name('fk_product_sales_product_id');
            $table->unsignedInteger('quantity');  // Adjusted to unsigned integer
            $table->decimal('price_at_sale', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);  // Added default value for discount
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sales');
    }
};
