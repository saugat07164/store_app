<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'customer_id', 
        'sale_date', 
        'total_amount', 
        'payment_method', 
        'status'
    ];
    protected $casts = [
        'sale_date' => 'datetime',
    ];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sales')
                    ->withPivot('quantity', 'price_at_sale', 'discount');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
