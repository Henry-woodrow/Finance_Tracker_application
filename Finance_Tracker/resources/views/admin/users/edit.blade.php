<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Edit User</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-700 text-white min-h-screen">
@include('layouts.navigation')

<div class="container mx-auto px-4 pt-32">
    <h2 class="text-4xl font-bold text-white text-center mb-8">Edit User</h2>

    <div class="max-w-xl mx-auto bg-gray-800 rounded-xl shadow-lg p-8">
        <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
            @csrf
            @method('PUT')


            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                       class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password <span class="text-gray-400">(leave blank to keep current)</span></label>
                <input type="password" id="password" name="password"
                       class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-lg transition duration-300">
                Save Changes
            </button>
        </form>
    </div>
</div>
</body>
</html>
