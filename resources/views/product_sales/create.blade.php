@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Create Product</h1>

    @if (session()->has('message'))
        <div class="mb-4 text-green-500">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit" class="space-y-6">
        @csrf

        <!-- Name Field -->
        <div>
            <label for="name" class="block text-gray-700 font-medium mb-2">Name:</label>
            <input wire:model.defer="name" type="text" id="name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('name') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
        </div>

        <!-- Description Field -->
        <div>
            <label for="description" class="block text-gray-700 font-medium mb-2">Description:</label>
            <textarea wire:model.defer="description" id="description" rows="4" class="w-full p-3 border border-gray-300 rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-600"></textarea>
            @error('description') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
        </div>

        <!-- Brand Field -->
        <div>
            <label for="brand_id" class="block text-gray-700 font-medium mb-2">Brand:</label>
            <select wire:model="brand_id" id="brand_id" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Select Brand --</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
            @error('brand_id') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
        </div>

        <!-- Category Field -->
        <div>
            <label for="category_id" class="block text-gray-700 font-medium mb-2">Category:</label>
            <select wire:model="category_id" id="category_id" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">-- Select Category --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
        </div>

        <!-- Price Field -->
        <div>
            <label for="price" class="block text-gray-700 font-medium mb-2">Price:</label>
            <input wire:model.defer="price" type="text" id="price" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('price') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
        </div>

        <!-- Cost Price Field -->
        <div>
            <label for="cost_price" class="block text-gray-700 font-medium mb-2">Cost Price:</label>
            <input wire:model.defer="cost_price" type="text" id="cost_price" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('cost_price') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
        </div>

        <!-- Quantity in Stock Field -->
        <div>
            <label for="quantity_in_stock" class="block text-gray-700 font-medium mb-2">Quantity in Stock:</label>
            <input wire:model.defer="quantity_in_stock" type="number" id="quantity_in_stock" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('quantity_in_stock') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
        </div>

        <!-- Warranty Period Field -->
        <div>
            <label for="warranty_period_months" class="block text-gray-700 font-medium mb-2">Warranty Period (Months):</label>
            <input wire:model.defer="warranty_period_months" type="number" id="warranty_period_months" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('warranty_period_months') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
        </div>

        <!-- Is Accessory Field -->
        <div class="flex items-center">
            <input wire:model="is_accessory" type="checkbox" id="is_accessory" class="form-checkbox h-5 w-5 text-blue-600">
            <label for="is_accessory" class="ml-2 text-gray-700 font-medium">Is Accessory</label>
            @error('is_accessory') <small class="text-red-500 text-sm ml-2">{{ $message }}</small> @enderror
        </div>

        <!-- Images Upload Field -->
        <div>
            <label for="images" class="block text-gray-700 font-medium mb-2">Product Images:</label>
            <input wire:model="images" type="file" id="images" multiple class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('images.*') <small class="text-red-500 text-sm">{{ $message }}</small> @enderror
        </div>

        <!-- Preview Selected Images -->
        <div>
            @if ($images)
                <ul class="flex flex-wrap mt-4 gap-2">
                    @foreach ($images as $index => $image)
                        <li class="relative">
                            <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="w-24 h-24 object-cover rounded-lg">
                            <button type="button" wire:click="removeImage({{ $index }})" class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center hover:bg-red-700">
                                &times;
                            </button>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="w-full p-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Create Product
            </button>
        </div>
    </form>
</div>
@endsection
