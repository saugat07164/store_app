@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl shadow-xl p-8 space-y-6">
        <h1 class="text-3xl font-extrabold text-gray-800 mb-4 border-b pb-2">{{ $title }}</h1>

       <!-- resources/views/repair_jobs/edit.blade.php -->
<!-- resources/views/repair_jobs/edit.blade.php -->

<form action="{{ route('repair-jobs.update', $repairJob->id) }}" method="POST" class="space-y-6">
    @csrf
    @method('PUT')

    <!-- Display validation errors -->
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Customer Selection -->
    <div class="form-group">
        <label for="customer_id" class="block text-sm font-medium text-gray-700">Customer</label>
        <select name="customer_id" id="customer_id" class="form-control mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" 
                    {{ $repairJob->customer_id == $customer->id ? 'selected' : '' }}>
                    {{ $customer->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Device Type -->
    <div class="form-group">
        <label for="device_type" class="block text-sm font-medium text-gray-700">Device Type</label>
        <input type="text" name="device_type" id="device_type" class="form-control mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
               value="{{ old('device_type', $repairJob->device_type) }}" required>
    </div>

    <!-- Device Brand (required field) -->
    <div class="form-group">
        <label for="device_brand" class="block text-sm font-medium text-gray-700">Device Brand</label>
        <input type="text" name="device_brand" id="device_brand" class="form-control mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
               value="{{ old('device_brand', $repairJob->device_brand) }}" required>
    </div>

    <!-- Issue Description (required field) -->
    <div class="form-group">
        <label for="issue_description" class="block text-sm font-medium text-gray-700">Issue Description</label>
        <textarea name="issue_description" id="issue_description" class="form-control mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  required>{{ old('issue_description', $repairJob->issue_description) }}</textarea>
    </div>

    <!-- Status -->
    <div class="form-group">
        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" id="status" class="form-control mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            <option value="pending" {{ old('status', $repairJob->status) == 'pending' ? 'selected' : '' }}>Pending</option>
            <option value="in_progress" {{ old('status', $repairJob->status) == 'in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="awaiting_parts" {{ old('status', $repairJob->status) == 'awaiting_parts' ? 'selected' : '' }}>Awaiting Parts</option>
            <option value="completed" {{ old('status', $repairJob->status) == 'completed' ? 'selected' : '' }}>Completed</option>
            <option value="cancelled" {{ old('status', $repairJob->status) == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
        </select>
    </div>

   <!-- Repair Date -->
<div class="form-group">
    <label for="repair_date" class="block text-sm font-medium text-gray-700">Repair Date</label>
    <input type="date" name="repair_date" id="repair_date" class="form-control mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
           value="{{ old('repair_date', \Carbon\Carbon::parse($repairJob->repair_date)->toDateString()) }}" required>
</div>

<!-- Completion Date -->
<div class="form-group">
    <label for="completion_date" class="block text-sm font-medium text-gray-700">Completion Date</label>
    <input type="date" name="completion_date" id="completion_date" class="form-control mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
           value="{{ old('completion_date', $repairJob->completion_date ? \Carbon\Carbon::parse($repairJob->completion_date)->toDateString() : '') }}">
</div>


    <!-- Total Cost (required field) -->
    <div class="form-group">
        <label for="total_cost" class="block text-sm font-medium text-gray-700">Total Cost</label>
        <input type="number" name="total_cost" id="total_cost" class="form-control mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
               value="{{ old('total_cost', $repairJob->total_cost) }}" required>
    </div>

    <!-- Submit Button -->
    <div class="form-group mt-6">
        <button type="submit" class="btn btn-primary px-4 py-2 bg-indigo-600 text-white rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Update Repair Job
        </button>
    </div>
</form>

<!-- Display validation errors -->
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    </div>
</div>
@endsection
