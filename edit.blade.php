@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl p-8 space-y-6">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-4 border-b pb-2">{{ $title }}</h1>

        <form action="{{ route($resourceName . '.update', $item) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $item->name) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                <textarea name="description" rows="4"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">{{ old('description', $item->description) }}</textarea>
                @error('description') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Brand --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Brand</label>
                <select name="brand_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">-- Select Brand --</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" {{ old('brand_id', $item->brand_id) == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
                @error('brand_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Category --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Category</label>
                <select name="category_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">-- Select Category --</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Price --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Price</label>
                <input type="text" name="price" value="{{ old('price', $item->price) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('price') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Cost Price --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Cost Price</label>
                <input type="text" name="cost_price" value="{{ old('cost_price', $item->cost_price) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('cost_price') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Quantity in Stock --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Quantity in Stock</label>
                <input type="number" name="quantity_in_stock" value="{{ old('quantity_in_stock', $item->quantity_in_stock) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('quantity_in_stock') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Warranty Period --}}
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Warranty Period (Months)</label>
                <input type="number" name="warranty_period_months" value="{{ old('warranty_period_months', $item->warranty_period_months) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400">
                @error('warranty_period_months') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Is Accessory --}}
            <div class="flex items-center space-x-2">
                <input type="checkbox" name="is_accessory" id="is_accessory" value="1"
                       class="form-checkbox h-5 w-5 text-blue-600 rounded" {{ old('is_accessory', $item->is_accessory) ? 'checked' : '' }}>
                <label for="is_accessory" class="text-sm font-semibold text-gray-700">Is Accessory</label>
            </div>
            @error('is_accessory') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror

            {{-- Submit --}}
            <div class="pt-4">
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-200">
                    Update Product
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
