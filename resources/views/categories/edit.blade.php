@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
    <div class="max-w-2xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-6">{{ $title }}</h1>

        <form action="{{ route($resourceName . '.update', $item) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <!-- Name Field -->
            <div>
                <label class="block font-medium mb-1">Name:</label>
                <input type="text" name="name" class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200" value="{{ old('name', $item->name) }}">
                @error('name') <small class="text-red-600">{{ $message }}</small> @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
