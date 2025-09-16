<?php
namespace App\Livewire;

use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductImage;

class ProductCreate extends Component
{
    use WithFileUploads;

    public $name;
    public $description;
    public $category_id;
    public $brand_id;
    public $sku;
    public $price;
    public $cost_price;
    public $quantity_in_stock;
    public $warranty_period_months;
    public $is_accessory = false;
    public $status = 'available';
    public $images = [];  // Array to hold temporary uploaded files
    public $uploadedImages = [];
    public $temporaryImages = [];  // Array to hold already uploaded files (for edit scenarios)

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'category_id' => 'required|exists:categories,id',
        'brand_id' => 'required|exists:brands,id',
        'sku' => 'required|string|unique:products,sku',
        'price' => 'required|numeric|min:0',
        'cost_price' => 'required|numeric|min:0',
        'quantity_in_stock' => 'required|integer|min:0',
        'warranty_period_months' => 'required|integer|min:0',
        'is_accessory' => 'boolean',
        'status' => 'in:available,sold,out_of_stock',
        'images.*' => 'image|max:2048', // Validate each image
    ];

    protected function generateSku()
    {
        $category = Category::find($this->category_id);
        $brand = Brand::find($this->brand_id);

        if (!$category || !$brand) {
            throw new \Exception('Category or Brand not found.');
        }

        $sku = strtoupper(substr($category->name, 0, 3)) . '-' .
               strtoupper(substr($brand->name, 0, 3)) . '-' .
               strtoupper(Str::random(5)); 

        while (Product::where('sku', $sku)->exists()) {
            $sku = strtoupper(substr($category->name, 0, 3)) . '-' .
                   strtoupper(substr($brand->name, 0, 3)) . '-' .
                   strtoupper(Str::random(5));
        }

        $this->sku = $sku;
    }
    public function updatedImages($value)
    {
        // When new images are selected, merge them with existing ones
        if ($value) {
            $this->temporaryImages = array_merge($this->temporaryImages, $value);
            $this->images = $this->temporaryImages;
        }
    }
    // Remove an image from the array
    public function removeImage($index)
    {
        if (isset($this->temporaryImages[$index])) {
            array_splice($this->temporaryImages, $index, 1);
            $this->images = $this->temporaryImages;
        }
    }

    // Save the product
    public function save()
    {
        $this->generateSku();
        $this->validate();

        $product = Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'sku' => $this->sku,
            'price' => $this->price,
            'cost_price' => $this->cost_price,
            'quantity_in_stock' => $this->quantity_in_stock,
            'warranty_period_months' => $this->warranty_period_months,
            'is_accessory' => $this->is_accessory,
            'status' => $this->status,
        ]);

        foreach ($this->images as $image) {
            $path = $image->store('products', 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
            ]);
        }

        session()->flash('message', 'Product created successfully!');
        return redirect()->route('products.index');
    }

    public function render()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('livewire.product-create', compact('categories', 'brands'));
    }
}