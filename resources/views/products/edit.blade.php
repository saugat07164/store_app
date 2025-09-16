@extends('layouts.app')

@section('content')
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <livewire:product-edit :product="$item" :key="'product-edit-' . $item->id" />
        </div>
    </div>
@endsection