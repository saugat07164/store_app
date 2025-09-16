@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">{{ $title }}</h1>

    <form action="{{ route('customers.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Name Field -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-medium mb-2">Name:</label>
            <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('name') }}">
            @error('name')
                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
            @enderror
        </div>

        <!-- Phone Field -->
        <div class="mb-4">
            <label for="phone" class="block text-gray-700 font-medium mb-2">Phone:</label>
            <input type="text" name="phone" id="phone" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('phone') }}">
            @error('phone')
                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
            @enderror
        </div>

        <!-- Email Field -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">Email:</label>
            <input type="email" name="email" id="email" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('email') }}">
            @error('email')
                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full p-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 cursor-pointer">
            Create
        </button>
    </form>
</div>
@endsection
