@extends('layouts.app')
@section('content'){{-- Portfolio Section --}}
{{-- Owner Portfolio --}}
<div class="flex flex-col items-center text-center mb-12">
    <img src="{{ asset('people/profile.jpg') }}" alt="Owner Profile" class="w-32 h-32 rounded-full shadow-md mb-4">
    <h3 class="text-xl font-semibold text-gray-800">Santosh Ghimire</h3>
    <p class="text-gray-600 text-md mt-1">Certified Computer Technician & Owner</p>
</div>

{{-- About Us --}}
<div class="bg-white py-12 px-6 lg:px-24">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">About Us</h2>
        <p class="text-gray-700 text-lg leading-relaxed mb-8">
            We specialize in the complete repair and servicing of all types of laptops and desktops.
            In addition to expert repairs, we also offer brand new laptops and desktops at affordable prices.
        </p>
        <div class="text-gray-800 text-md font-medium">
            For more information, feel free to contact us:<br>
            📞 <a href="tel:9807029231" class="text-blue-600 hover:underline">9807029231</a> or
            <a href="tel:9842575153" class="text-blue-600 hover:underline">9842575153</a>
        </div>
    </div>
</div>

@endsection