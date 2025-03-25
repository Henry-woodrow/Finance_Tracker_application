<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-700 text-white font-sans pt-24"> <!-- Improved professional styling -->
    @include('layouts.navigation')

    <div class="container mx-auto mt-16 px-6">
        <div class="text-center mb-12 p-8 bg-gray-800 rounded-lg shadow-lg">
            <h1 class="text-6xl font-extrabold text-white">Finance Dashboard</h1>
            <p class="text-gray-300 mt-3 text-lg">Track and manage your financial status with ease</p>
        </div>

        <div class="flex justify-center mb-12">
            <div class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white p-16 rounded-2xl shadow-2xl text-center">
                <h1 class="text-8xl font-extrabold">
                    {{ $number ?? 55 }}
                </h1>
                <p class="text-xl mt-2 font-light">Current Balance</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6 justify-center">
            <button
                onclick="window.location='{{ route('salary_form') }}'"
                class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">

                Add Salary
            </button>
            <button class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">
                Add Monthly
            </button>
            <button class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">
                Add Weekly
            </button>
            <button class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">
                Add Goal
            </button>
            <button class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">
                Add Bill
            </button>
        </div>
    </div>
</body>
</html>
