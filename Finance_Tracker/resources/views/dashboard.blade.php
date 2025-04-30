<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('goalValidation', {
                validateAmount(goalId, maxAmount) {
                    const input = document.getElementById(`amount_${goalId}`);
                    const error = document.getElementById(`error_${goalId}`);
                    if (parseFloat(input.value) > maxAmount) {
                        error.textContent = `Amount exceeds the remaining target of £${maxAmount.toFixed(2)}.`;
                        input.classList.add('border-red-500');
                    } else {
                        error.textContent = '';
                        input.classList.remove('border-red-500');
                    }
                }
            });
        });
    </script>
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-700 text-white font-sans pt-24">
    @include('layouts.navigation')

    <div class="container mx-auto mt-16 px-6">
        <!-- Header -->
        <div class="text-center mb-12 p-8 bg-gray-800 rounded-lg shadow-lg">
            <h1 class="text-6xl font-extrabold text-white">Finance Dashboard</h1>
            <p class="text-gray-300 mt-3 text-lg">Track and manage your financial status with ease</p>
        </div>

        <!-- Balance Display -->
        <div x-data="{ goals: [] }" class="relative flex flex-wrap justify-center gap-6 items-center">
            <template x-if="goals.length === 0">
                <div class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white p-16 rounded-2xl shadow-2xl text-center transition-all duration-300">
                    <h1 class="text-8xl font-extrabold">£{{$number ?? 0 }}</h1>
                    <p class="text-xl mt-2 font-light">Current Balance</p>
                </div>
            </template>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-wrap justify-center gap-6 mt-8">
            @if ($number == 0)
                <button onclick="window.location='{{ route('salary_form') }}'" class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">Add Salary</button>
                <button onclick="window.location='{{ route('monthly_form') }}'" class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">Add Monthly</button>
                <button onclick="window.location='{{ route('weekly_form') }}'" class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">Add Weekly</button>
                @else
                <button onclick="window.location='{{ route('goal.add') }}'" class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">Add Goal/Manage Goals</button>
                <button class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">Add Bill/Manage Bills</button>
                <button class="bg-blue-600 hover:bg-blue-800 text-white font-semibold py-4 px-8 rounded-xl shadow-lg transition transform hover:scale-110">Add 1 Off Payments</button>
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
                                    <div class="bg-blue-600 h-4 rounded-full" style="width: {{ min(($goal->current_amount / $goal->goal_amount) * 100, 100) }}%;"></div>
                                </div>
                                <p class="text-gray-300 mt-2 text-sm">Progress: {{ number_format(min(($goal->current_amount / $goal->goal_amount) * 100, 100), 2) }}%</p>
                            </div>

                            <!-- Add to Goal Form -->
                            <div x-show="activeGoal === {{ $goal->id }}" class="mt-4" x-data="goalValidation">
                                <form action="{{ route('goal.update', $goal) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-4">
                                        <label for="current_amount" class="block text-sm font-medium text-gray-300 mb-2">Add to Goal</label>
                                        <input type="number"
                                            name="current_amount"
                                            id="amount_{{ $goal->id }}"
                                            placeholder="Enter amount"
                                            max="{{ ($goal->goal_amount - $goal->current_amount) }}"
                                            oninput="Alpine.store('goalValidation').validateAmount({{ $goal->id }}, {{ ($goal->goal_amount - $goal->current_amount) }})"
                                            class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                            required>
                                        <p id="error_{{ $goal->id }}" class="text-red-400 text-sm mt-2"></p>
                                        @error('current_amount')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-lg transition duration-300">Add to Goal</button>
                                </form>

                                <!-- Delete Goal Form -->
                                <form action="{{ route('goal.destroy', $goal->id) }}" method="POST" class="mt-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg shadow-lg transition duration-300">Delete Goal</button>
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
