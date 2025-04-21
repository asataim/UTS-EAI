<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - BreakSide</title>
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
            <img src="{{ asset('images/logo.png') }}" alt="BreakSide Logo" class="mx-auto h-24 w-auto mb-4">
            <h1 class="text-3xl font-bold text-white mb-2">Create Account</h1>
            <p class="text-gray-400">Join BreakSide today</p>
        </div>

        <div class="bg-custom-gray shadow-lg rounded-lg p-8">
            @if ($errors->any())
                <div class="bg-red-500 text-white p-4 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-300">Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                            class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm focus:ring-custom-red focus:border-custom-red text-gray-300">
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-300">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm focus:ring-custom-red focus:border-custom-red text-gray-300">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-300">Password</label>
                        <input id="password" type="password" name="password" required
                            class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm focus:ring-custom-red focus:border-custom-red text-gray-300">
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-300">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                            class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm focus:ring-custom-red focus:border-custom-red text-gray-300">
                    </div>

                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-300">Role</label>
                        <select id="role" name="role" required
                            class="mt-1 block w-full bg-gray-700 border-gray-600 rounded-md shadow-sm focus:ring-custom-red focus:border-custom-red text-gray-300">
                            <option value="">Select a role</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-custom-red text-white px-4 py-2 rounded hover:bg-red-700 transition-colors duration-300">
                        Create Account
                    </button>
                </div>
            </form>

            <div class="mt-6 text-center">
                <p class="text-gray-400">Already have an account?</p>
                <a href="{{ route('login') }}" class="text-custom-red hover:text-red-700">
                    Sign in
                </a>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('prelogin') }}" class="text-gray-400 hover:text-gray-300">
                ← Back to Home
            </a>
        </div>
    </div>
</body>
</html> 