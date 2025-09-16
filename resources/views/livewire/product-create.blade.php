<div>
    <h2 class="text-2xl font-semibold mb-6">Create Product</h2>

    @if (session()->has('message'))
        <div class="mb-4 text-green-500">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save" class="space-y-6" enctype="multipart/form-data">
        <!-- Product Name -->
        <div wire:key="product-name">
            <label for="name" class="block font-medium">Name</label>
            <input type="text" id="name" wire:model="name" placeholder="Product Name" class="w-full p-2 border rounded">
            @error('name') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <!-- Product Description -->
        <div wire:key="product-description">
            <label for="description" class="block font-medium">Description</label>
            <textarea id="description" wire:model="description" placeholder="Product Description" class="w-full p-2 border rounded"></textarea>
            @error('description') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <!-- Product Category -->
        <div wire:key="product-category_id">
            <label for="category_id" class="block font-medium">Category</label>
            <select id="category_id" wire:model="category_id" class="w-full p-2 border rounded">
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <!-- Product Brand -->
        <div wire:key="product-brand_id">
            <label for="brand_id" class="block font-medium">Brand</label>
            <select id="brand_id" wire:model="brand_id" class="w-full p-2 border rounded">
                <option value="">Select Brand</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
            @error('brand_id') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <!-- Product Price -->
        <div wire:key="product-price">
            <label for="price" class="block font-medium">Price</label>
            <input type="number" id="price" wire:model="price" placeholder="Price" step="0.01" class="w-full p-2 border rounded">
            @error('price') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <!-- Product Cost Price -->
        <div wire:key="product-cost_price">
            <label for="cost_price" class="block font-medium">Cost Price</label>
            <input type="number" id="cost_price" wire:model="cost_price" placeholder="Cost Price" step="0.01" class="w-full p-2 border rounded">
            @error('cost_price') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <!-- Product Quantity in Stock -->
        <div wire:key="product-quantity_in_stock">
            <label for="quantity_in_stock" class="block font-medium">Quantity in Stock</label>
            <input type="number" id="quantity_in_stock" wire:model="quantity_in_stock" placeholder="Quantity in Stock" class="w-full p-2 border rounded">
            @error('quantity_in_stock') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <!-- Product Warranty Period -->
        <div wire:key="product-warranty_period_months">
            <label for="warranty_period_months" class="block font-medium">Warranty Period (Months)</label>
            <input type="number" id="warranty_period_months" wire:model="warranty_period_months" placeholder="Warranty Period (Months)" class="w-full p-2 border rounded">
            @error('warranty_period_months') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <!-- Is Accessory -->
        <div wire:key="product-is_accessory">
            <label for="is_accessory" class="block font-medium">Is Accessory</label>
            <input type="checkbox" id="is_accessory" wire:model="is_accessory" class="p-2 border rounded">
            @error('is_accessory') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>

        <!-- Product Status -->
        <div wire:key="product-status">
            <label for="status" class="block font-medium">Status</label>
            <select id="status" wire:model="status" class="w-full p-2 border rounded">
                <option value="available">Available</option>
                <option value="sold">Sold</option>
                <option value="out_of_stock">Out of Stock</option>
            </select>
            @error('status') <small class="text-red-500">{{ $message }}</small> @enderror
        </div>





        
        <div wire:key="product-images" class="mb-6">
    <label for="images" class="block text-lg font-semibold text-gray-700">Product Images</label>
    
    <!-- File Input with Tailwind Styling -->
    <div class="mt-2">
        <input type="file" name="images[]" id="images" multiple wire:model="images"
               class="block w-full text-sm text-gray-700 border border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 file:py-2 file:px-4 file:mr-4 file:rounded-full file:border-0 file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
               accept="image/*">
    </div>

    <!-- Error Message -->
    @error('images.*') 
        <span class="text-red-500 text-sm mt-2">{{ $message }}</span> 
    @enderror

    <!-- Selected Images Preview Section -->
    @if (count($temporaryImages) > 0)
        <div class="mt-4">
            <h3 class="text-sm font-medium text-gray-700 mb-2">Selected Images ({{ count($temporaryImages) }})</h3>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4">
                @foreach ($temporaryImages as $index => $image)
                    <div class="relative group">
                        <div class="flex flex-col items-center border border-gray-300 p-2 rounded-lg bg-white">
                            <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-full h-24 object-contain rounded-md">
                            <button type="button" 
                                    wire:click="removeImage({{ $index }})" 
                                    class="mt-2 px-2 py-1 bg-red-500 text-white text-xs rounded hover:bg-red-600 transition-colors">
                                Remove
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>







        <!-- Submit Button -->
        <div wire:key="product-submit">
        <button type="submit" class="cursor-pointer w-full p-3 bg-blue-600 text-white rounded-lg" wire:loading.attr="disabled">
    Save Product
</button>

        </div>
    </form>
</div>
