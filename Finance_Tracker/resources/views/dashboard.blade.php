<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-700 text-white font-sans pt-24">
    @include('layouts.navigation')

    <div class="container mx-auto mt-16 px-6">
        <div class="text-center mb-12 p-8 bg-gray-800 rounded-lg shadow-lg">
            <h1 class="text-6xl font-extrabold text-white">Finance Dashboard</h1>
            <p class="text-gray-300 mt-3 text-lg">Track and manage your financial status with ease</p>
        </div>

        <!-- Main Content -->
        <div x-data="{ goals: [] }" class="relative flex flex-wrap justify-center gap-6 items-center">
            <!-- Current Balance or Goal Box -->
            <template x-if="goals.length === 0">
                <div
                    class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white p-16 rounded-2xl shadow-2xl text-center transition-all duration-300">
                    <h1 class="text-8xl font-extrabold">
                        £{{ $number ?? 0 }}
                    </h1>
                    <p class="text-xl mt-2 font-light">Current Balance</p>
                </div>
            </template>

            <!-- Goal Box -->
            <template x-for="goal in goals" :key="goal.id">
                <div
                    class="bg-gray-800 text-white p-16 rounded-2xl shadow-2xl text-center transition-all duration-300">
                    <h2 class="text-4xl font-bold">Goal</h2>
                    <p class="text-lg mt-2" x-text="goal.name"></p>
                </div>
            </template>

            <!-- Add Goal Button -->
            <button
                @click="goals.push({ id: goals.length + 1, name: 'New Goal' })"
                class="flex items-center justify-center w-16 h-16 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg transition-transform duration-300 transform hover:scale-110">
                +
            </button>
        </div>

        <!-- Existing Buttons -->
        <div class="flex flex-wrap justify-center gap-6 mt-8">
            @if ($number == 0)
                <button
                    onclick="window.location='{{ route('salary_form') }}'"
                    class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">
                    Add Salary
                </button>
            @endif
            @if ($number == 0)
                <button
                    class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">
                    Add Monthly
                </button>
            @endif
            @if ($number == 0)
                <button
                    class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">
                    Add Weekly
                </button>
            @endif
            @if ($number != 0)
                <button
                    class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">
                    Add Goal
                </button>
            @endif
            @if ($number != 0)
                <button
                    class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">
                    Add Bill
                </button>
            @endif
        </div>
    </div>
</body>
</html>
