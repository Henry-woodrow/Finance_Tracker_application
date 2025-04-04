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
                        £{{$salary ?? 0 }}
                    </h1>
                    <p class="text-xl mt-2 font-light">Current Balance</p>
                </div>
            </template>
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
                    onclick="window.location='{{ route('goal.add') }}'"
                    class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">
                    Add Goal/Manage Goals
                </button>
            @endif
            @if ($number != 0)
                <button
                    class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">
                    Add Bill/ Manage Bills
                </button>
            @endif
            @if ($number != 0)
                <button
                    class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">
                    Add 1 off Payments
                </button>
            @endif
        </div>
        <!-- Goals Section -->
@if ($goals->isNotEmpty())
<div class="mt-16">
    <h2 class="text-4xl font-bold text-center text-white mb-8">Goals</h2>
    <div x-data="{ activeGoal: null }" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($goals as $goal)
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg">
                <!-- Goal Details -->
                <div @click="activeGoal = activeGoal === {{ $goal->id }} ? null : {{ $goal->id }}" class="cursor-pointer">
                    <h3 class="text-2xl font-bold text-white">{{ $goal->goal_name }}</h3>
                    <p class="text-gray-300 mt-2">Goal Amount: £{{ number_format($goal->goal_amount, 2) }}</p>
                    <p class="text-gray-300 mt-2">Current Amount Raised: £{{ number_format($goal->current_amount, 2) }}</p>
                    <div class="w-full bg-gray-700 rounded-full h-4 mt-4">
                        <div class="bg-blue-600 h-4 rounded-full"
                            style="width: {{ ($goal->current_amount / $goal->goal_amount) * 100 }}%;"></div>
                    </div>
                    <p class="text-gray-300 mt-2 text-sm">
                        Progress: {{ number_format(($goal->current_amount / $goal->goal_amount) * 100, 2) }}%
                    </p>
                </div>

                <!-- Popup Form -->
                <div x-show="activeGoal === {{ $goal->id }}" class="mt-4">
                    <form action="{{ route('goal.update', $goal) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="current_amount" class="block text-sm font-medium text-gray-300 mb-2">Add to Goal</label>
                            <input type="number" name="current_amount" id="amount_{{ $goal->id }}" placeholder="Enter amount"
                                class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        </div>
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-lg transition duration-300">
                            Add to Goal
                        </button>
                    </form>

                    <!-- Delete Goal Form -->
                    <form action="{{ route('goal.destroy', $goal) }}" method="POST" class="mt-4">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg shadow-lg transition duration-300">
                            Delete Goal
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif


    </div>
</body>
</html>
