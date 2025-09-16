<?php
namespace App\Livewire;
use Livewire\Component;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Sale;

class SaleForm extends Component
{
    public $customer_id;
    public $saleProducts = [];
    public $payment_method;
    public $status;
    public $sale_date;
    public $total_amount = 0;  // Add total_amount property
    public $products;
    public $customers;

    public function mount()
    {
        $this->products = Product::all();
        $this->customers = Customer::all();
        $this->saleProducts[] = ['product_id' => '', 'quantity' => '', 'price_at_sale' => ''];
    }

    public function addProduct()
    {
        $this->saleProducts[] = ['product_id' => '', 'quantity' => '', 'price_at_sale' => ''];
    }

    public function removeProduct($index)
    {
        unset($this->saleProducts[$index]);
        $this->saleProducts = array_values($this->saleProducts);
    }

    public function updatedSaleProducts()
    {
        $this->updateTotalAmount();
    }

    public function updateTotalAmount()
    {
        $total = 0;
        foreach ($this->saleProducts as $productData) {
            $total += $productData['quantity'] * $productData['price_at_sale'];
        }
        $this->total_amount = $total;  // Update total_amount
    }

    public function submit()
    {
        $this->validate([
            'customer_id' => 'required',
            'saleProducts.*.product_id' => 'required',
            'saleProducts.*.quantity' => 'required|numeric|min:1',
            'saleProducts.*.price_at_sale' => 'required|numeric',
            'payment_method' => 'required',
            'status' => 'required',
            'sale_date' => 'required|date',
        ]);

        // Create the sale directly in Livewire
        $sale = Sale::create([
            'customer_id' => $this->customer_id,
            'sale_date' => $this->sale_date,
            'total_amount' => $this->total_amount,  // Use the updated total_amount
            'payment_method' => $this->payment_method,
            'status' => $this->status,
        ]);

        // Attach products and update stock
        foreach ($this->saleProducts as $productData) {
            $sale->products()->attach($productData['product_id'], [
                'quantity' => $productData['quantity'],
                'price_at_sale' => $productData['price_at_sale'],
            ]);

            // Update stock
            $product = Product::findOrFail($productData['product_id']);
            $product->quantity_in_stock -= $productData['quantity']; // Reduce stock by sold quantity
            $product->save();
        }

        session()->flash('success', 'Sale created successfully.');
        return redirect()->route('sales.index');
    }

    public function render()
    {
        return view('livewire.sale-form');
    }
}
