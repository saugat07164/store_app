@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Add a Brand</h1>

    <form action="{{ route('brands.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Brand Name Field -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Name:</label>
            <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('name') }}">
            @error('name')
                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full p-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
            Create Brand
        </button>
    </form>
</div>
@endsection
