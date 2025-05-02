<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin – Manage Users</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-700 text-white min-h-screen">
    @include('layouts.navigation')

    <div class="container mx-auto px-4 pt-32">
        <h2 class="text-4xl font-bold text-white text-center mb-8">Admin Panel – User Management</h2>

        @if(session('success'))
            <div class="bg-green-600 p-4 rounded-lg mb-6 text-white text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="overflow-x-auto bg-gray-800 rounded-xl shadow-lg p-6">
            <table class="min-w-full text-sm text-left text-gray-300">
                <thead class="text-xs uppercase text-gray-400 border-b border-gray-700">
                    <tr>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr class="border-b border-gray-700 hover:bg-gray-700">
                            <td class="px-4 py-3">{{ $user->email }}</td>
                            <td class="px-4 py-3 flex flex-wrap gap-2">
                                <a href="{{ route('admin.users.edit', $user) }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">Edit</a>

                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
