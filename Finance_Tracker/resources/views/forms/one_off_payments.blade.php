<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One-Off Payment</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-700 text-white min-h-screen">
    @include('layouts.navigation')

    <div class="container mx-auto mt-32 px-4">
        <h2 class="text-center text-4xl font-bold text-white mb-8">Add One-Off Payment</h2>
        <div class="max-w-lg mx-auto bg-gray-800 p-8 rounded-lg shadow-lg">
            <form action="{{ route('gifts.store') }}" method="POST">
                @csrf

                <!-- Payment Name Field -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Payment Name</label>
                    <input type="text" id="gift_name" name="gift_name" placeholder="e.g. Birthday Gift, Refund"
                    class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                <!-- Amount Field -->
                <div class="mb-6">
                    <label for="amount" class="block text-sm font-medium text-gray-300 mb-2">Amount</label>
                    <input type="number" step="0.01" id="amount" name="amount" placeholder="Enter amount"
                        class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>


                    <!-- Amount Field -->
                    <div class="mb-6">
                    <label for="gift_description" class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                    <input type="text" step="0.01" id="gift_description" name="gift_description" placeholder="Description"
                        class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-lg transition duration-300">
                    Submit
                </button>
            </form>
        </div>
    </div>
</body>
</html>
