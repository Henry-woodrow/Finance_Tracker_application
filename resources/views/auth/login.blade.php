<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-700 text-white min-h-screen flex items-center justify-center">
    <div class="w-full max-w-md p-8 bg-gray-800 rounded-xl shadow-xl">
        <h2 class="text-3xl font-bold text-center mb-6">Welcome Back</h2>

        @if(session('status'))
            <div class="mb-4 text-sm text-green-500">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm mb-2">Email</label>
                <input id="email" type="email" name="email" required autofocus
                    class="w-full px-4 py-2 rounded-lg text-gray-900 focus:ring-2 focus:ring-blue-500 outline-none" />
                @error('email')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm mb-2">Password</label>
                <input id="password" type="password" name="password" required
                    class="w-full px-4 py-2 rounded-lg text-gray-900 focus:ring-2 focus:ring-blue-500 outline-none" />
                @error('password')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mb-6">

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-400 hover:underline">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 py-3 rounded-lg font-semibold transition shadow-lg">
                Login
            </button>
        </form>

        <p class="text-sm text-center mt-6 text-gray-300">
            Don’t have an account?
            <a href="{{ route('register') }}" class="text-blue-400 hover:underline">Register</a>
        </p>
    </div>
</body>
</html>
