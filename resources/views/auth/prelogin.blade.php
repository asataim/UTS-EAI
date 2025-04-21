<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BreakSide - Welcome</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #1a1a1a;
        }
        .bg-custom-gray {
            background-color: #2d2d2d;
        }
        .bg-custom-red {
            background-color: #dc2626;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full mx-4">
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="BreakSide Logo" class="mx-auto h-32 w-auto mb-4">
            <h1 class="text-4xl font-bold text-white mb-2">BreakSide</h1>
            <p class="text-gray-400">Your Style, Your Statement</p>
        </div>

        <div class="bg-custom-gray shadow-lg rounded-lg p-8">
            <div class="space-y-4">
                <a href="{{ route('login') }}" class="block w-full bg-custom-red text-white text-center px-4 py-3 rounded hover:bg-red-700 transition-colors duration-300">
                    Login
                </a>
                <a href="{{ route('register') }}" class="block w-full bg-gray-700 text-white text-center px-4 py-3 rounded hover:bg-gray-600 transition-colors duration-300">
                    Register
                </a>
            </div>

            <div class="mt-8 text-center">
                <p class="text-gray-400">Or continue as</p>
                <a href="{{ route('user.dashboard') }}" class="inline-block mt-4 text-custom-red hover:text-red-700">
                    Guest
                </a>
            </div>
        </div>

        <div class="mt-8 text-center text-gray-500 text-sm">
            <p>&copy; {{ date('Y') }} BreakSide. All rights reserved.</p>
        </div>
    </div>
</body>
</html> 