@extends('layouts.app')
@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">{{ $title ?? 'Brands' }}</h1>

    <a href="{{ route('brands.create') }}" class="mb-4 inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
        Create New
    </a>

    @if(session('success'))
    <div class="mb-4 rounded-lg bg-green-100 px-6 py-5 text-base text-green-800" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if($brands->isEmpty())
        <p class="text-center text-gray-600 font-semibold">No brands to show</p>
    @else
        <table class="min-w-full table-auto border-collapse">
            <thead>
                <tr class="bg-blue-200 text-black">
                    <th class="px-6 py-3 text-left">SN</th>
                    <th class="px-6 py-3 text-left">Name</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($brands as $index => $brand)
                    <tr class="bg-blue-50 hover:bg-blue-100 transition-colors">
                        <td class="px-6 py-3">{{ $index + 1 }}</td>
                        <td class="px-6 py-3">{{ $brand->name }}</td>
                        <td class="px-6 py-3 flex gap-2">
                            <a href="{{ route('brands.edit', $brand) }}" class="px-4 py-2 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-colors">Edit</a>
                            <form action="{{ route('brands.destroy', $brand) }}" method="POST" onsubmit="return confirm('Delete this brand?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-colors">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
{{ $brands->links() }}

</div>
@endsection
