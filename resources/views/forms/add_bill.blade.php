<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Bill</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-700 text-white min-h-screen">
    @include('layouts.navigation')

    <div class="container mx-auto mt-32 px-4">
        <h2 class="text-center text-4xl font-bold text-white mb-8">Add a New Bill</h2>
        <div class="max-w-lg mx-auto bg-gray-800 p-8 rounded-lg shadow-lg">
            <form action="{{ route('bills.store') }}" method="POST">
                @csrf

                <!-- Bill Name -->
                <div class="mb-6">
                    <label for="bill_name" class="block text-sm font-medium text-gray-300 mb-2">Bill Name</label>
                    <input type="text" id="bill_name" name="bill_name" placeholder="e.g. Electricity, Rent"
                        class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                <!-- Amount -->
                <div class="mb-6">
                    <label for="amount" class="block text-sm font-medium text-gray-300 mb-2">Amount (£)</label>
                    <input type="number" step="0.01" id="amount" name="amount" placeholder="Enter amount"
                        class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                <!-- Due Date (optional) -->
                <div class="mb-6">
                    <label for="due_date" class="block text-sm font-medium text-gray-300 mb-2">Due Date (optional)</label>
                    <input type="date" id="due_date" name="due_date"
                        class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <!-- Recurring Checkbox -->
                <div class="mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="is_recurring" value="1" class="form-checkbox text-blue-500">
                        <span class="ml-2 text-white">Recurring Bill</span>
                    </label>
                </div>

                <!-- Recurring Type Dropdown -->
                <div class="mb-6">
                    <label for="recurring_type" class="block text-sm font-medium text-gray-300 mb-2">Recurring Type</label>
                    <select id="recurring_type" name="recurring_type"
                        class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">None</option>
                        <option value="weekly">Weekly</option>
                        <option value="monthly">Monthly</option>
                    </select>
                </div>


                <!-- Submit -->
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-lg transition duration-300">
                    Add Bill
                </button>
            </form>
        </div>
    </div>
</body>
</html>
