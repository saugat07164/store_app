    <form wire:submit.prevent="submit" class="space-y-6">
        <div>
            <label class="block font-medium">Customer</label>
            <select wire:model="customer_id" class="w-full p-2 border rounded">
                <option value="">Select</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                @endforeach
            </select>
            @error('customer_id') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <!-- Product Fields -->
        <div>
            <label class="block font-medium">Products</label>
            @foreach($saleProducts as $index => $saleProduct)
                <div class="grid grid-cols-4 gap-4 mb-2">
                    <select wire:model="saleProducts.{{ $index }}.product_id" class="p-2 border rounded">
                        <option value="">Select</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>

                    <input type="number" wire:model="saleProducts.{{ $index }}.quantity" placeholder="Qty" class="p-2 border rounded" min="1">
                    <input type="number" wire:model="saleProducts.{{ $index }}.price_at_sale" placeholder="Price" class="p-2 border rounded" step="0.01">

                    <button type="button" wire:click="removeProduct({{ $index }})" class="text-red-500 font-bold">X</button>
                </div>
            @endforeach
            <button type="button" wire:click="addProduct" class="text-blue-600">+ Add Product</button>
        </div>

        <!-- Other Fields -->
        <div>
            <label>Payment Method</label>
            <select wire:model="payment_method" class="w-full p-2 border rounded">
                <option value="">Select</option>
                <option value="cash">Cash</option>
                <option value="card">Card</option>
                <option value="upi">UPI</option>
            </select>
            @error('payment_method') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <div>
            <label>Status</label>
            <select wire:model="status" class="w-full p-2 border rounded">
                <option value="">Select</option>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
            </select>
            @error('status') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <div>
            <label>Sale Date</label>
            <input type="date" wire:model="sale_date" class="w-full p-2 border rounded">
            @error('sale_date') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="p-3 bg-blue-600 text-white rounded-lg">Submit</button>
    </form>

