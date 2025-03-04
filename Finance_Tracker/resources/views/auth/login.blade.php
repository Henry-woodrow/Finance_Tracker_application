<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('layouts.navigation')
</head>
<body class="bg-gray-100">

        <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-center">Login</h2>
            <form method="POST" action="{{ route('login') }}" class="mt-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" required
                        class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                </div>

                <div class="mt-4 relative" x-data="{ show: false }">
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input :type="show ? 'text' : 'password'" name="password" required
                        class="w-full mt-1 px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300">
                    <button type="button" @click="show = !show"
                        class="absolute right-3 top-9 text-sm text-gray-500">
                        <span x-show="!show">Show</span>
                        <span x-show="show">Hide</span>
                    </button>
                </div>

                <div class="mt-4 flex justify-between items-center">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="mr-2">
                        Remember Me
                    </label>
                    <a href="{{ route('password.request') }}" class="text-blue-600 text-sm">Forgot Password?</a>
                </div>

                <button type="submit"
                    class="w-full mt-6 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">
                    Login
                </button>
            </form>
        </div>




</body>
</html>
