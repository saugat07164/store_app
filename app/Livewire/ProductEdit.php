<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductEdit extends Component
{
    use WithFileUploads;

    public $product;
    public $name;
    public $description;
    public $category_id;
    public $brand_id;
    public $price;
    public $cost_price;
    public $quantity_in_stock;
    public $warranty_period_months;
    public $is_accessory = false;
    public $status;
    public $images = [];
    public $existingImages = [];

    public function mount($product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->category_id = $product->category_id;
        $this->brand_id = $product->brand_id;
        $this->price = $product->price;
        $this->cost_price = $product->cost_price;
        $this->quantity_in_stock = $product->quantity_in_stock;
        $this->warranty_period_months = $product->warranty_period_months;
        $this->is_accessory = $product->is_accessory;
        $this->status = $product->status;
        $this->existingImages = $product->images;
    }

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'brand_id' => 'required|exists:brands,id',
        'price' => 'required|numeric|min:0',
        'cost_price' => 'required|numeric|min:0',
        'quantity_in_stock' => 'required|integer|min:0',
        'warranty_period_months' => 'required|integer|min:0',
        'is_accessory' => 'boolean',
        'status' => 'required|in:available,sold,out_of_stock',
        'images.*' => 'image|max:2048',
    ];

    public function save()
    {
        $this->validate();

        $this->product->update([
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'price' => $this->price,
            'cost_price' => $this->cost_price,
            'quantity_in_stock' => $this->quantity_in_stock,
            'warranty_period_months' => $this->warranty_period_months,
            'is_accessory' => $this->is_accessory,
            'status' => $this->status,
        ]);

        if ($this->images) {
            foreach ($this->images as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $this->product->id,
                    'image_path' => $path,
                ]);
            }
        }

        session()->flash('message', 'Product updated successfully!');
        return redirect()->route('products.index');
    }

    public function deleteImage($imageId)
    {
        $image = ProductImage::findOrFail($imageId);
        Storage::disk('public')->delete($image->image_path);
        $image->delete();
        $this->existingImages = $this->existingImages->filter(fn($img) => $img->id != $imageId);
        session()->flash('message', 'Image deleted successfully!');
    }

    public function render()
    {
        return view('livewire.product-edit', [
            'categories' => Category::all(),
            'brands' => Brand::all()
        ]);
    }
}