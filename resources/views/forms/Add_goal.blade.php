<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Goal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-700 text-white min-h-screen">
    @include('layouts.navigation')

    <div class="container mx-auto mt-32 px-4">
        <h2 class="text-center text-4xl font-bold text-white mb-8">Enter Your Goal</h2>
        <div class="max-w-lg mx-auto bg-gray-800 p-8 rounded-lg shadow-lg">
            <form action="{{ route('goal.store') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="goal_name" class="block text-sm font-medium text-gray-300 mb-2">Goal Name</label>
                    <input type="text" id="goal_name" name="goal_name" placeholder="Enter your goal name"
                        class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                <div class="mb-6">
                    <label for="goal_amount" class="block text-sm font-medium text-gray-300 mb-2">Goal Amount</label>
                    <input type="number" id="goal_amount" name="goal_amount" placeholder="Enter your goal amount"
                        class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                <div class="mb-6">
                    <label for="due_date" class="block text-sm font-medium text-gray-300 mb-2">Due Date</label>
                    <input type="date" id="due_date" name="due_date"
                        class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-lg transition duration-300">
                    Submit
                </button>
            </form>
        </div>
    </div>
</body>
</html>
