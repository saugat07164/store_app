@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">{{ $title ?? 'Sales' }}</h1>

    <a href="{{ route('sales.create') }}" class="mb-4 inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
        Create Sale
    </a>

    @if(session('success'))
        <div class="alert alert-success mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if($sales->isEmpty())
        <p class="text-center text-gray-600 font-semibold">No sales to show</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-blue-200 text-black">
                        <th class="px-6 py-3 text-left">Customer</th>
                        <th class="px-6 py-3 text-left">Products</th>
                        <th class="px-6 py-3 text-left">Sale Date</th>
                        <th class="px-6 py-3 text-left">Total Amount</th>
                        <th class="px-6 py-3 text-left">Payment</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sales as $sale)
                        <tr class="bg-blue-50 hover:bg-blue-100 transition-colors">
                            <td class="px-6 py-3">{{ $sale->customer->name }}</td>
                            <td class="px-6 py-3">
                                @foreach ($sale->products as $product)
                                    <span class="inline-block bg-gray-200 text-gray-800 px-2 py-1 rounded text-xs mb-1">
                                        {{ $product->name }}
                                    </span>
                                @endforeach
                            </td>
                            <td class="px-6 py-3">{{ $sale->sale_date->format('Y-m-d H:i') }}</td>
                            <td class="px-6 py-3">Rs. {{ number_format($sale->total_amount, 2) }}</td>
                            <td class="px-6 py-3">{{ ucfirst($sale->payment_method) }}</td>
                            <td class="px-6 py-3">
                                <span class="inline-block px-2 py-1 text-xs rounded 
                                    {{ 
                                        $sale->status === 'completed' ? 'bg-green-200 text-green-800' :
                                        ($sale->status === 'pending' ? 'bg-yellow-200 text-yellow-800' :
                                        'bg-red-200 text-red-800')
                                    }}">
                                    {{ ucfirst($sale->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-3 flex flex-wrap gap-2">
                                <a href="{{ route('sales.edit', $sale) }}" class="px-4 py-2 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-colors">Edit</a>
                                <form action="{{ route('sales.destroy', $sale) }}" method="POST" onsubmit="return confirm('Delete this sale?')">
                                    @csrf @method('DELETE')
                                    <button class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-colors">Delete</button>
                                </form>
                              <a href="{{ route('sales.download-invoice', $sale->id) }}" 
   class="inline-flex items-center justify-center p-2 text-lg text-blue-600 hover:text-blue-800 transition">
    <i class="fa fa-download" aria-hidden="true"></i>
</a>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $sales->links() }}
        </div>
    @endif
</div>
@endsection
