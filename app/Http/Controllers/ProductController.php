<?php

namespace App\Http\Controllers;
use App\Livewire\ProductCreate;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('brand', 'category')->paginate(10);
        return view('products.index', [
            'items' => $products,
            'title' => 'Products',
            'resourceName' => 'products'
        ])->with('welcome_products', $products);
    }

    public function create()
    {
        // This will now return the Livewire component for the create form
        return view('products.create');
    }

    

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'sku' => 'nullable|string|max:255',  // We will generate this if not provided
            'price' => 'required|numeric',
            'cost_price' => 'required|numeric',
            'quantity_in_stock' => 'required|numeric',
            'warranty_period_months' => 'required|numeric',
            'is_accessory' => 'nullable|boolean',
        ]);
        $brand = Brand::find($request->brand_id);
        $productName = $request->name;
    
        // Generate SKU by concatenating brand name and product name, sanitized
        $skuBase = strtoupper(str_replace([' ', '-', '_'], '', $brand->name . '-' . $productName));
    
        // Check if SKU already exists, if so, add a number suffix to make it unique
        $sku = $skuBase;
        $counter = 1;
        while (Product::where('sku', $sku)->exists()) {
            $sku = $skuBase . '-' . $counter;
            $counter++;
        }
    
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'sku' => $sku,
            'price' => $request->price,
            'cost_price' => $request->cost_price,
            'quantity_in_stock' => $request->quantity_in_stock,
            'warranty_period_months' => $request->warranty_period_months,
            'is_accessory' => $request->has('is_accessory') ? $request->is_accessory : false,

        ]);
    
        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        $existingImages = $product->images;
        return view('products.show', [
            'item' => $product->load('brand', 'category'),  // Eager load 'brand' and 'category' relationships
            'title' => 'Product Details',                   // A title to pass to the view
            'resourceName' => 'products',                   // Resource name for potential use in the view
            'existingImages' => $existingImages            // Pass the images to the view
        ]);
    }

    public function edit(Product $product)
    {
        return view('products.edit', [
            'item' => $product->load('brand', 'category', 'images'),
            'brands' => Brand::all(),
            'categories' => Category::all(),
            'title' => 'Edit Product',
            'resourceName' => 'products'
        ]);
    }


    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id'
        ]);

        $product->update($request->only('name', 'brand_id', 'category_id'));

        return redirect()->route('products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }

    public function showWelcomePage()
{
    // Fetch products along with related brand, category, and images
    $products = Product::with('brand', 'category', 'images')->paginate(6);

    // Pass the data to the 'welcome' view
    return view('welcome', [
        'products' => $products,  // This will pass the data to the view
    ]);
}


}
