@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold mb-6">{{ $title }}</h1>

    <div class="flex flex-wrap items-center mb-4 p-4 border rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 hover:bg-gray-50">
        <div class="w-1/4">
        <div>
    <h4>Existing Images:</h4>
    @foreach ($existingImages as $image)
        <img src="{{ asset('storage/' . $image->image_path) }}" width="100">
    @endforeach
</div>

        </div>
        <div class="w-3/4 pl-4">
            <div class="mb-3 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-300">
                <strong><i class="fas fa-id-badge"></i> ID:</strong> {{ $item->id }}
            </div>
            <div class="mb-3 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-300">
                <strong><i class="fas fa-box"></i> Name:</strong> {{ $item->name }}
            </div>
 <!-- Product Description -->
 <div class="mb-3 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-300">
                <strong><i class="fas fa-exclamation-circle"></i> Product Description:</strong> {{ $item->description }}
            </div>

            <div class="mb-3 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-300">
                <strong><i class="fas fa-barcode"></i> SKU-Code:</strong> {{ $item->sku }}
            </div>
            <div class="mb-3 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-300">
                <strong><i class="fas fa-cogs"></i> Brand:</strong> {{ $item->brand->name ?? 'N/A' }}
            </div>
            <div class="mb-3 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-300">
                <strong><i class="fas fa-tag"></i> Category:</strong> {{ $item->category->name ?? 'N/A' }}
            </div>
            <div class="mb-3 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-300">
                <strong><i class="fas fa-coins"></i> Price:</strong> 
                     Nrs. {{ number_format($item->price, 2) ?? 'N/A' }}
            </div>
            <div class="mb-3 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-300">
                <strong><i class="fas fa-money-bill-wave"></i> Cost Price:</strong> 
                Nrs. {{ number_format($item->cost_price, 2) ?? 'N/A' }}
            </div>
<!-- Quantity in Stock -->
<div class="mb-3 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-300">
    <strong><i class="fas fa-boxes"></i> Quantity in Stock:</strong> {{ $item->quantity_in_stock }}
</div>

        </div>
    </div>

    <div class="mt-4 flex flex-row gap-4">
        <a href="{{ route($resourceName . '.edit', $item) }}" class="btn btn-warning bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route($resourceName . '.index') }}" class="btn btn-secondary bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>
@endsection
