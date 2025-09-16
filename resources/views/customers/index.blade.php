@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-2xl font-semibold text-gray-800 mb-6">{{ $title }}</h1>

    <a href="{{ route($resourceName . '.create') }}" class="mb-3 inline-block p-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
        Create New
    </a>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-300 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if($items->isEmpty())
        <p class="text-center text-gray-600 font-semibold">No records to show</p>
    @else
        <div class="overflow-x-auto shadow-lg rounded-lg bg-white">
            <table class="min-w-full table-auto text-left">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-gray-600 font-medium">SN</th>
                        <th class="px-6 py-3 text-gray-600 font-medium">Name</th>
                        <th class="px-6 py-3 text-gray-600 font-medium">Phone</th>
                        <th class="px-6 py-3 text-gray-600 font-medium">Email</th>
                        <th class="px-6 py-3 text-gray-600 font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $index => $item)
                    <tr class="border-b">
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $item->name }}</td>
                        <td class="px-6 py-4">{{ $item->phone }}</td>
                        <td class="px-6 py-4">{{ $item->email }}</td>
                        <td class="px-6 py-4 space-x-2">
                            <a href="{{ route($resourceName . '.edit', $item) }}" class="btn btn-sm p-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">Edit</a>
                            <form action="{{ route($resourceName . '.destroy', $item) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Delete this customer?')" class="btn btn-sm p-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
