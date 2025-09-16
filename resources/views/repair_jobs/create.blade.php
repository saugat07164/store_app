@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Create Repair Job</h1>

    <form action="{{ route('repair-jobs.store') }}" method="POST" class="space-y-6">
        @csrf

        <!-- Customer -->
        <div class="mb-4">
            <label for="customer_id" class="block text-gray-700 font-medium mb-2">Customer:</label>
            <select name="customer_id" id="customer_id" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Select Customer</option>
                @foreach($customers as $customer)
                    <option value="{{ $customer->id }}" {{ old('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                @endforeach
            </select>
            @error('customer_id')
                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
            @enderror
        </div>

        <!-- Device Type -->
        <div class="mb-4">
            <label for="device_type" class="block text-gray-700 font-medium mb-2">Device Type:</label>
            <input type="text" name="device_type" id="device_type" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('device_type') }}">
            @error('device_type')
                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
            @enderror
        </div>

        <!-- Device Brand -->
        <div class="mb-4">
            <label for="device_brand" class="block text-gray-700 font-medium mb-2">Device Brand:</label>
            <input type="text" name="device_brand" id="device_brand" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('device_brand') }}">
            @error('device_brand')
                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
            @enderror
        </div>

        <!-- Issue Description -->
        <div class="mb-4">
            <label for="issue_description" class="block text-gray-700 font-medium mb-2">Issue Description:</label>
            <textarea name="issue_description" id="issue_description" rows="4" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">{{ old('issue_description') }}</textarea>
            @error('issue_description')
                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
            @enderror
        </div>

        <!-- Status -->
        <div class="mb-4">
            <label for="status" class="block text-gray-700 font-medium mb-2">Status:</label>
            <select name="status" id="status" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="awaiting_parts" {{ old('status') == 'awaiting_parts' ? 'selected' : '' }}>Awaiting Parts</option>
                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
            </select>
            @error('status')
                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
            @enderror
        </div>

        <!-- Repair Date -->
        <div class="mb-4">
            <label for="repair_date" class="block text-gray-700 font-medium mb-2">Repair Date:</label>
            <input type="datetime-local" name="repair_date" id="repair_date" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('repair_date') }}">
            @error('repair_date')
                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
            @enderror
        </div>

        <!-- Completion Date -->
        <div class="mb-4">
            <label for="completion_date" class="block text-gray-700 font-medium mb-2">Completion Date:</label>
            <input type="datetime-local" name="completion_date" id="completion_date" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('completion_date') }}">
            @error('completion_date')
                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
            @enderror
        </div>

        <!-- Total Cost -->
        <div class="mb-4">
            <label for="total_cost" class="block text-gray-700 font-medium mb-2">Total Cost:</label>
            <input type="text" name="total_cost" id="total_cost" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('total_cost') }}">
            @error('total_cost')
                <small class="text-red-500 text-sm mt-1">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="bg-blue-600 text-white py-2 px-6 rounded-lg">Create Repair Job</button>
    </form>
</div>
@endsection
