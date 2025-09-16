@extends('layouts.app')

@section('content')



   
    <!-- Main Content -->
    <div class="flex-1 container mx-auto px-4 py-8">
        <!-- Navigation links -->
        <div class="mb-6">
            <nav class="flex gap-6">
                <a href="{{ route('brands.index') }}" class="text-gray-800 hover:text-blue-600 transition-colors text-lg font-semibold">Brands</a>
                <a href="{{ route('categories.index') }}" class="text-gray-800 hover:text-blue-600 transition-colors text-lg font-semibold">Categories</a>
                <a href="{{ route('customers.index') }}" class="text-gray-800 hover:text-blue-600 transition-colors text-lg font-semibold">Customers</a>
                <a href="{{route('sales.index')}}" class="text-gray-800 hover:text-blue-600 transition-colors text-lg font-semibold">Sales</a>
                <a href="{{route('products.index')}}" class="text-gray-800 hover:text-blue-600 transition-colors text-lg font-semibold">Products</a>
                <a href="{{ route('repair-jobs.index') }}" class="text-gray-800 hover:text-blue-600 transition-colors text-lg font-semibold">Repair Jobs</a>
            </nav>
        </div>

        <!-- Heading -->
        <h2 class="text-3xl font-bold text-gray-900 mb-4">Store</h2>

        <!-- Product List -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($products as $product)
            <div class="bg-white shadow-md rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                <!-- Product Image -->
                <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" class="w-full h-48 object-contain">

                <!-- Product Details -->
                <div class="p-4">
                    <h3 class="text-xl font-semibold text-gray-900">{{ $product->name }}</h3>
                    <p class="text-gray-700 mt-2">Price: <span class="font-bold">Nrs.{{ number_format($product->price, 2) }}</span></p>
                    <p class="text-gray-600 mt-1">Brand: {{ $product->brand->name }}</p>
                    <p class="text-gray-600 mt-1">Category: {{ $product->category->name }}</p>

                    <!-- Action Button -->
                    <a href="{{ route('products.show', $product->id) }}" class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">View Details</a>
                </div>
            </div>
            @endforeach
            {{ $products->links() }}
        </div>
    </div>

</div>

@endsection
