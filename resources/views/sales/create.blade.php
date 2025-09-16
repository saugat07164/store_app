@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">{{ $title }}</h1>

    @livewire('sale-form') <!-- Correct usage of Livewire component -->
</div>
@endsection
