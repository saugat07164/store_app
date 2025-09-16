@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>

    <form action="{{ route('sales.update', $sale) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label for="customer_id">Customer</label>
            <select name="customer_id" id="customer_id" class="form-control" required>
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}" @if($customer->id == $sale->customer_id) selected @endif>
                        {{ $customer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="products">Products</label>
            <select name="products[]" id="products" class="form-control" multiple required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}"
                        @if($sale->products->contains($product->id)) selected @endif>
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-warning">Update Sale</button>
    </form>
@endsection
