<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name']; // Adjust based on your table structure

    public function products()
    {
        return $this->hasMany(Product::class); // Assuming a category can have many products
    }
}
