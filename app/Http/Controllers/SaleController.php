<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Exports\SaleInvoiceExport;
use Maatwebsite\Excel\Facades\Excel;


class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with(['customer', 'products'])->paginate(10);
        return view('sales.index', [
            'sales' => $sales,
            'title' => 'Sales',
            'resourceName' => 'sales'
        ]);
    }

    public function create()
    {
        return view('sales.create', [
            'title' => 'Create Sale',
            'resourceName' => 'sales',
            'customers' => Customer::all(),
            'products' => Product::all()
        ]);
    }

    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price_at_sale' => 'required|numeric|min:0',
            'sale_date' => 'required|date',
            'total_amount' => 'required|numeric',
            'payment_method' => 'required|string',
            'status' => 'required|string',
        ]);
    
        // Create the sale
        $sale = Sale::create([
            'customer_id' => $request->customer_id,
            'sale_date' => $request->sale_date,
            'total_amount' => $request->total_amount,
            'payment_method' => $request->payment_method,
            'status' => $request->status,
        ]);
    
        // Attach products with quantities and prices to the sale
        foreach ($request->products as $productData) {
            // Attach product to sale
            $sale->products()->attach($productData['id'], [
                'quantity' => $productData['quantity'],
                'price_at_sale' => $productData['price_at_sale'],
            ]);
    
            // Update the product's stock
            $product = Product::findOrFail($productData['id']);
            $product->quantity_in_stock -= $productData['quantity']; // Reduce stock by sold quantity
            $product->save();
        }
    
        return redirect()->route('sales.index')->with('success', 'Sale created successfully.');
    }
    
    public function edit(Sale $sale)
    {
        return view('sales.edit', [
            'sale' => $sale,
            'title' => 'Edit Sale',
            'resourceName' => 'sales',
            'customers' => Customer::all(),
            'products' => Product::all()
        ]);
    }

    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array',
            'products.*.id' => 'exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
        ]);

        // Update the sale
        $sale->update([
            'customer_id' => $request->customer_id,
        ]);

        foreach ($request->products as $productId => $productData) {
            $sale->products()->attach($productId, [
                'quantity' => $productData['quantity'],
                'price_at_sale' => $productData['price_at_sale'],
                'discount' => $productData['discount'],
            ]);
        }
        

        return redirect()->route('sales.index')->with('success', 'Sale updated successfully.');
    }

    public function destroy(Sale $sale)
    {
        // Loop through each product associated with the sale
        foreach ($sale->products as $product) {
            // Find the corresponding product
            $productRecord = Product::findOrFail($product->id);
            
            // Add the quantity back to the stock
            $productRecord->quantity_in_stock += $product->pivot->quantity; // Add the quantity back to stock
            $productRecord->save();
        }
    
        // Delete the sale
        $sale->delete();
        
        // Redirect with success message
        return redirect()->route('sales.index')->with('success', 'Sale deleted successfully.');
    }
    public function downloadInvoice(Sale $sale)
{
    $filename = 'invoice_sale_' . $sale->id . '.xlsx';
    return Excel::download(new SaleInvoiceExport($sale), $filename);
}


}
