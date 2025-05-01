<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Settings</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-700 text-white min-h-screen">
    @include('layouts.navigation')

    <div class="container mx-auto px-4 pt-24">
        <div class="max-w-xl mx-auto bg-gray-800 rounded-xl shadow-lg p-8">
            <div class="text-center mb-8">
            <form action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data" id="profilePhotoForm" class="text-center mb-8">
                @csrf
                <div class="relative w-32 h-32 mx-auto mb-4">
                    <img src="{{ Auth::user()->profile_photo_url }}" alt="Profile" class="rounded-full w-full h-full object-cover border-4 border-blue-600 cursor-pointer" onclick="document.getElementById('profile_photo').click()" />
                    <input type="file" id="profile_photo" name="profile_photo" class="hidden" onchange="document.getElementById('profilePhotoForm').submit()" />
                </div>
            </form>
                <h2 class="text-3xl font-bold">{{ auth()->user()->fresh()->email }}</h2>
            </div>

            <div class="space-y-6">
                <!-- Email Button -->
                <div>
                <a href="{{ route('email.edit') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg text-center shadow">
                    Change Email
                </a>
                </div>

                <!-- Password Button -->
                <div>
                    <a href="{{ route('password.edit') }}" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg text-center shadow">Change Password</a>
                </div>

                <div>
                    <a href="#" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg text-center shadow">Change salary</a>
                </div>

                <div>
                    <a href="#" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg text-center shadow">Change monthly</a>
                </div>

                <div>
                    <a href="#" class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg text-center shadow">Change weekly</a>
                </div>

                

                <!-- Theme Toggle -->
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-300">Theme</span>
                    <button type="button" id="themeToggle" class="bg-gray-700 px-4 py-2 rounded-full text-sm hover:bg-blue-600 transition">Toggle Light/Dark</button>
                </div>

                <div>
                    <a href="#" class="block w-full bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-lg text-center shadow">Reset</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('themeToggle').addEventListener('click', function () {
            document.body.classList.toggle('bg-white');
            document.body.classList.toggle('text-black');
        });
    </script>
</body>
</html>
