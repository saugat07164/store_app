<?php
namespace App\Http\Controllers;

use App\Models\ProductSale;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class ProductSaleController extends Controller
{
    public function index()
    {
        $items = ProductSale::with('product', 'sale')->get();
        return view('product_sales.index', [
            'items' => $items,
            'title' => 'Product Sales',
            'resourceName' => 'product_sales'
        ]);
    }

    public function create()
    {
        return view('product_sales.create', [
            'title' => 'Add Product to Sale',
            'resourceName' => 'product_sales',
            'products' => Product::all(),
            'sales' => Sale::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0'
        ]);

        ProductSale::create($request->only('sale_id', 'product_id', 'quantity', 'price'));

        return redirect()->route('product_sales.index')->with('success', 'Product added to sale.');
    }

    public function show(ProductSale $product_sale)
    {
        return view('product_sales.show', [
            'item' => $product_sale->load('product', 'sale'),
            'title' => 'Product Sale Details',
            'resourceName' => 'product_sales'
        ]);
    }

    public function edit(ProductSale $product_sale)
    {
        return view('product_sales.edit', [
            'item' => $product_sale,
            'title' => 'Edit Product Sale',
            'resourceName' => 'product_sales',
            'products' => Product::all(),
            'sales' => Sale::all()
        ]);
    }

    public function update(Request $request, ProductSale $product_sale)
    {
        $request->validate([
            'sale_id' => 'required|exists:sales,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0'
        ]);

        $product_sale->update($request->only('sale_id', 'product_id', 'quantity', 'price'));

        return redirect()->route('product_sales.index')->with('success', 'Product sale updated.');
    }

    public function destroy(ProductSale $product_sale)
    {
        $product_sale->delete();
        return redirect()->route('product_sales.index')->with('success', 'Product sale deleted.');
    }
}
