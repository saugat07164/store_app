@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $title }}</h1>

    <div><strong>Sale ID:</strong> {{ $item->sale_id }}</div>
    <div><strong>Product:</strong> {{ $item->product->name ?? 'N/A' }}</div>
    <div><strong>Quantity:</strong> {{ $item->quantity }}</div>
    <div><strong>Price:</strong> {{ $item->price }}</div>

    <a href="{{ route($resourceName . '.edit', $item) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route($resourceName . '.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
