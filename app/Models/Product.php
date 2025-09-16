<?php

namespace App\Models;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'brand_id',
        'sku',
        'price',
        'cost_price',
        'quantity_in_stock',
        'warranty_period_months',
        'status',
        'is_accessory'
    ];
 // Enum values for status
 const STATUS_AVAILABLE = 'available';
 const STATUS_SOLD = 'sold';
 const STATUS_OUT_OF_STOCK = 'out_of_stock';

 // Set the status attribute using enum
 public function setStatusSold()
 {
     $this->status = self::STATUS_SOLD;
     $this->save();
 }

    public function category()
{
    return $this->belongsTo(Category::class);  // Define relationship with Category
}
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function sales()
    {
        return $this->belongsToMany(Sale::class, 'product_sales')
                    ->withPivot('quantity', 'price_at_sale', 'discount');  // Including additional fields like quantity and price
    }
    public function images()
{
    return $this->hasMany(ProductImage::class);
}

}
