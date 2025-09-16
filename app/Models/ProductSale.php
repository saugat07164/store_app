<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductSale extends Pivot
{
    // Optionally, if you want to specify the table name for the pivot table
    protected $table = 'product_sales';

    // Define any fillable properties if necessary (e.g., quantity or price)
    protected $fillable = ['sale_id', 'product_id', 'quantity', 'price']; // Adjust fields based on your actual pivot table structure

    // You can also define any custom methods for this model if needed
}
