<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Change Email</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-700 text-white min-h-screen">
    @include('layouts.navigation')

    <div class="container mx-auto px-4 pt-24">
        <div class="max-w-xl mx-auto bg-gray-800 rounded-xl shadow-lg p-8">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-white">Change Email</h2>
                <p class="text-gray-400 text-sm mt-1">Update your account email address</p>
            </div>

            @if (session('success'))
                <div class="bg-green-600 text-white text-sm font-medium px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('email.update') }}">
                @csrf

                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">New Email Address</label>
                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email', Auth::user()->email) }}"
                        class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        required
                    />
                    @error('email')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between items-center">
                    <a href="{{ route('profile.edit') }}" class="text-sm text-gray-400 hover:underline">Back to Settings</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-300">
                        Update Email
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
