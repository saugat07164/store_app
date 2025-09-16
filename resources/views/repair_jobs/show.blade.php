@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">Repair Job Details</h1>

    <div class="flex flex-wrap items-center mb-4 p-4 border rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 hover:bg-gray-50">
        <div class="w-full">
            <!-- Customer -->
            <div class="mb-3 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-300">
                <strong><i class="fas fa-user"></i> Customer:</strong> {{ $repairJob->customer->name ?? 'N/A' }}
            </div>

            <!-- Device Type -->
            <div class="mb-3 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-300">
                <strong><i class="fas fa-mobile-alt"></i> Device Type:</strong> {{ $repairJob->device_type }}
            </div>

            <!-- Device Brand -->
            <div class="mb-3 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-300">
                <strong><i class="fas fa-cogs"></i> Device Brand:</strong> {{ $repairJob->device_brand }}
            </div>

            <!-- Issue Description -->
            <div class="mb-3 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-300">
                <strong><i class="fas fa-exclamation-circle"></i> Issue Description:</strong> {{ $repairJob->issue_description }}
            </div>

            <!-- Status -->
            <div class="mb-3 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-300">
                <strong><i class="fas fa-check-circle"></i> Status:</strong> {{ ucfirst($repairJob->status) }}
            </div>

            <!-- Repair Date -->
            <div class="mb-3 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-300">
                <strong><i class="fas fa-calendar-alt"></i> Repair Date:</strong> {{ \Carbon\Carbon::parse($repairJob->repair_date)->format('M d, Y h:i A') }}
            </div>

            <!-- Completion Date -->
            <div class="mb-3 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-300">
                <strong><i class="fas fa-calendar-check"></i> Completion Date:</strong> 
                {{ $repairJob->completion_date ? \Carbon\Carbon::parse($repairJob->completion_date)->format('M d, Y h:i A') : 'N/A' }}
            </div>

            <!-- Total Cost -->
            <div class="mb-3 hover:bg-gray-100 p-2 rounded-lg transition-colors duration-300">
                <strong><i class="fas fa-dollar-sign"></i> Total Cost:</strong> Nrs.{{ number_format($repairJob->total_cost, 2) }}
            </div>
        </div>
    </div>

    <div class="mt-4 flex flex-row gap-4">
        <a href="{{ route('repair-jobs.edit', $repairJob) }}" class="btn btn-warning bg-yellow-500 hover:bg-yellow-600 text-white py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out">
            <i class="fas fa-edit"></i> Edit
        </a>
        <a href="{{ route('repair-jobs.index') }}" class="btn btn-secondary bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded-lg shadow-md transition duration-200 ease-in-out">
            <i class="fas fa-arrow-left"></i> Back
        </a>
    </div>
</div>
@endsection
