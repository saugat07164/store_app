@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $title }}</h1>

    <form action="{{ isset($item) ? route($resourceName . '.update', $item) : route($resourceName . '.store') }}" method="POST">
        @csrf
        @if(isset($item)) @method('PUT') @endif

        <div class="mb-3">
            <label>Sale:</label>
            <select name="sale_id" class="form-control">
                <option value="">Select Sale</option>
                @foreach($sales as $sale)
                    <option value="{{ $sale->id }}"
                        {{ old('sale_id', $item->sale_id ?? '') == $sale->id ? 'selected' : '' }}>
                        {{ $sale->id }}
                    </option>
                @endforeach
            </select>
            @error('sale_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Product:</label>
            <select name="product_id" class="form-control">
                <option value="">Select Product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}"
                        {{ old('product_id', $item->product_id ?? '') == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
            @error('product_id') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Quantity:</label>
            <input type="number" name="quantity" class="form-control" min="1"
                   value="{{ old('quantity', $item->quantity ?? 1) }}">
            @error('quantity') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Price:</label>
            <input type="number" step="0.01" name="price" class="form-control"
                   value="{{ old('price', $item->price ?? 0) }}">
            @error('price') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button class="btn btn-success">{{ isset($item) ? 'Update' : 'Add' }}</button>
    </form>
</div>
@endsection
