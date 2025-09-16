@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $title }}</h1>

    <div class="mb-3">
        <strong>ID:</strong> {{ $item->id }}
    </div>
    <div class="mb-3">
        <strong>Name:</strong> {{ $item->name }}
    </div>

    <a href="{{ route($resourceName . '.edit', $item) }}" class="btn btn-warning">Edit</a>
    <a href="{{ route($resourceName . '.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
