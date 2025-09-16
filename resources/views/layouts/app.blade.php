<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LaptopHospital')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    {{-- Navbar --}}
    <header class="bg-white shadow-md z-10 my-4">
    
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between gap-4 items-center">
        <div class="flex space-x-4 items-center">
        <button id="showsidebar" class="cursor-pointer my-4 p-2 rounded-md bg-gray-200 hover:bg-gray-300 shadow-md focus:outline-none">
  <div class="space-y-1">
    <span class="block w-4 h-0.5 bg-gray-800"></span>
    <span class="block w-4 h-0.5 bg-gray-800"></span>
    <span class="block w-4 h-0.5 bg-gray-800"></span>
  </div>
</button>

            <a href="{{ url('/') }}" class="text-2xl font-bold text-blue-600">LaptopHospital</a>
</div>
            <nav class="space-x-4">
            <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600">Home</a>
                <a href="{{route('products.index')}}" class="text-gray-700 hover:text-blue-600">Products</a>
                <a href="{{route('sales.index')}}" class="text-gray-700 hover:text-blue-600">Sales</a>
                <a href="{{route('about')}}" class="text-gray-700 hover:text-blue-600">About</a>
            </nav>
        </div>
    </header>
    <!-- Wrapper with flex layout -->
<div class="flex min-h-screen">
 <!-- Sidebar -->
 <aside id="sidebar" class="w-64 min-h-screen z-0 bg-white border-r p-4" x-data="{ open1: false, open2: false, open3: false, open4: false }">
 <button id="hidemenu" class="cursor-pointer text-sm my-4 px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded shadow-md">
 <span class="text-lg">←</span>
  <span>Hide Menu</span>
</button>

 <nav class="space-y-2">
<!-- Products -->
<div>
                <button @click="open1 = !open1" class="flex items-center justify-between w-full text-left text-gray-800 font-semibold">
                    Products
                    <span x-show="!open1">▶</span><span x-show="open1">▼</span>
                </button>
                <div x-show="open1" class="pl-4 mt-2 space-y-2" x-transition>
                    <!-- Level 2 -->
                    <div>
                    <a href="{{route('products.index')}}" class="block text-gray-700 hover:text-blue-500">Products in Store</a>
                    <a href="{{route('products.create')}}" class="block text-gray-700 hover:text-blue-500">Add Products</a>
                    </div>
                </div>
            </div>

           <!-- Sales -->
<div>
                <button @click="open2 = !open2" class="flex items-center justify-between w-full text-left text-gray-800 font-semibold">
                    Sales
                    <span x-show="!open2">▶</span><span x-show="open2">▼</span>
                </button>
                <div x-show="open2" class="pl-4 mt-2 space-y-2" x-transition>
                    <!-- Level 2 -->
                    <div>
                    <a href="{{route('sales.index')}}" class="block text-gray-700 hover:text-blue-500">Sales Records</a>
                    <a href="{{route('sales.create')}}" class="block text-gray-700 hover:text-blue-500">Create a sales record</a>
                    </div>
                </div>
            </div>

  <!-- Repair Jobs -->
  <div>
                <button @click="open3 = !open3" class="flex items-center justify-between w-full text-left text-gray-800 font-semibold">
                    Repairs and Servicing
                    <span x-show="!open3">▶</span><span x-show="open3">▼</span>
                </button>
                <div x-show="open3" class="pl-4 mt-2 space-y-2" x-transition>
                    <!-- Level 2 -->
                    <div>
                    <a href="{{route('repair-jobs.index')}}" class="block text-gray-700 hover:text-blue-500">Repair Jobs Records</a>
                    <a href="{{route('repair-jobs.create')}}" class="block text-gray-700 hover:text-blue-500">Start Repair/Service</a>
                    </div>
                </div>
            </div>



 <!-- Customers -->
 <div>
                <button @click="open4 = !open4" class="flex items-center justify-between w-full text-left text-gray-800 font-semibold">
                Customers
                    <span x-show="!open4">▶</span><span x-show="open4">▼</span>
                </button>
                <div x-show="open4" class="pl-4 mt-2 space-y-2" x-transition>
                    <!-- Level 2 -->
                    <div>
                    <a href="{{route('customers.index')}}" class="block text-gray-700 hover:text-blue-500">Customers List</a>
                    <a href="{{route('customers.create')}}" class="block text-gray-700 hover:text-blue-500">Register a Customer</a>
                    </div>
                </div>
            </div>



        </nav>
    </aside>

    <!-- {{-- Flash Messages --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 max-w-3xl mx-auto mt-4 rounded shadow">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-4 max-w-3xl mx-auto mt-4 rounded shadow">
            {{ session('error') }}
        </div>
    @endif -->

    {{-- Main Content --}}
    <main class="flex-grow">
        <div class="max-w-7xl mx-8 px-8>
            @yield('content')
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-white border-t mt-10 z-10">
        <div class="max-w-7xl mx-auto px-4 py-6 text-sm text-gray-600 flex justify-between items-center">
            <span>&copy; {{ date('Y') }} LaptopHospital. All rights reserved.</span>
            <span>Made with ❤️ by Saugat</span>
        </div>
    </footer>
    @livewireScripts
</body>
</html>
