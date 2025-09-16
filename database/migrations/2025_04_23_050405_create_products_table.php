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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            
            $table->foreignId('category_id')
                  ->constrained('categories')
                  ->cascadeOnDelete()
                  ->index()
                  ->name('fk_products_category_id');  // Name the constraint here
    
            $table->foreignId('brand_id')
                  ->constrained('brands')
                  ->cascadeOnDelete()
                  ->index()
                  ->name('fk_products_brand_id');  // Name the constraint here
    
            $table->string('sku')->unique();
            $table->decimal('price', 10, 2);
            $table->decimal('cost_price', 10, 2);
            $table->unsignedBigInteger('quantity_in_stock');
            $table->unsignedBigInteger('warranty_period_months');
            $table->boolean('is_accessory')->default(false);
            $table->enum('status', ['available', 'sold', 'out_of_stock'])->default('available');
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
