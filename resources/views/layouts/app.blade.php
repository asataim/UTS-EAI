<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BreakSide') }}</title>

    <!-- Scripts -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Additional Styles -->
    <style>
        [x-cloak] { display: none !important; }
        .bg-custom-gray { background-color: #1a1a1a; }
        .text-custom-red { color: #ff3333; }
        .hover\:text-custom-red:hover { color: #ff3333; }
        .border-custom-red { border-color: #ff3333; }
        .bg-custom-red { background-color: #ff3333; }
        .hover\:bg-custom-red:hover { background-color: #ff3333; }
    </style>

    @stack('scripts')
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-900">
        <!-- Navigation -->
        @auth
            <nav class="bg-custom-gray shadow-lg">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                <a href="{{ auth()->user()->isAdmin() ? route('admin.dashboard') : route('user.dashboard') }}" class="flex items-center">
                                    <img src="{{ asset('images/logo.png') }}" alt="BreakSide Logo" class="h-8 w-auto">
                                    <span class="ml-2 text-xl font-bold text-custom-red">BreakSide</span>
                                </a>
                            </div>
                        </div>

                        <!-- Navigation Links -->
                        <div class="flex items-center">
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="text-gray-300 hover:text-custom-red px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">
                                    Dashboard
                                </a>
                            @else
                                <a href="{{ route('user.dashboard') }}" class="text-gray-300 hover:text-custom-red px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">
                                    Products
                                </a>
                                <a href="{{ route('cart.view') }}" class="text-gray-300 hover:text-custom-red px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">
                                    Cart
                                </a>
                            @endif
                            
                            <!-- Logout Form -->
                            <form method="POST" action="{{ route('logout') }}" class="ml-4">
                                @csrf
                                <button type="submit" class="text-gray-300 hover:text-custom-red px-3 py-2 rounded-md text-sm font-medium transition-colors duration-300">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        @endauth

        <!-- Page Content -->
        <main>
            @if(session('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-green-900 border border-green-700 text-green-300 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-red-900 border border-red-700 text-red-300 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html> 