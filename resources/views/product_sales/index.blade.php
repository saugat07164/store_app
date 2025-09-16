@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $title }}</h1>

    <a href="{{ route('product-sales.create') }}" class="btn btn-primary mb-3">Add Product to Sale</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th><th>Sale ID</th><th>Product</th><th>Quantity</th><th>Price</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->sale_id }}</td>
                <td>{{ $item->product->name ?? 'N/A' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price }}</td>
                <td>
                    <a href="{{ route($resourceName . '.show', $item) }}" class="btn btn-sm btn-info">View</a>
                    <a href="{{ route($resourceName . '.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route($resourceName . '.destroy', $item) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this item?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
