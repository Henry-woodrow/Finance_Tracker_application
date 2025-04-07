<!-- filepath: /d:/repostories/Finance_Tracker_application/Finance_Tracker/resources/views/forms/salary_form.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Salary Form</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-700 text-white min-h-screen">
    @include('layouts.navigation')

    <div class="container mx-auto mt-32 px-4">
        <h2 class="text-center text-4xl font-bold text-white mb-8">Enter Your Salary</h2>
        <div class="max-w-lg mx-auto bg-gray-800 p-8 rounded-lg shadow-lg">
            <form action="{{ route('salary.store') }}" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="salary" class="block text-sm font-medium text-gray-300 mb-2">Salary Amount</label>
                    <input type="number" id="salary" name="salary" placeholder="Enter your salary"
                        class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
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
