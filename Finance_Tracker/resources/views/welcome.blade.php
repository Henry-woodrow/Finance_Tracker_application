<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Tracker</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('layouts.navigation')
</head>
<body class="bg-gray-100">



  <!-- Hero Section -->
  <section class="h-screen flex items-center justify-center bg-gradient-to-r from-gray-500 to-black text-white text-center px-6">
    <div>
        <h1 class="text-5xl font-extrabold">Welcome</h1>
        <p class="mt-4 text-lg">Find out more about the finance tracker</p>
        <a href="#content" class="mt-6 inline-block bg-white text-black px-6 py-3 rounded-full font-semibold hover:bg-gray-200 transition">
            Learn More
        </a>
    </div>
</section>

<!-- Main Content -->
<section id="content" class="max-w-5xl mx-auto mt-20 p-6 bg-white shadow-lg rounded-lg">
    <h2 class="text-3xl font-bold text-gray-800">About Us</h2>
    <p class="mt-4 text-gray-600">Some highlights</p>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="p-6 bg-gray-200 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-700">track your money</h3>
            <p class="mt-2 text-gray-600">great for tracking money</p>
        </div>
        <div class="p-6 bg-gray-200 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-700">Responsive</h3>
            <p class="mt-2 text-gray-600">Looks great on all devices.</p>
        </div>
        <div class="p-6 bg-gray-200 rounded-lg shadow-md">
            <h3 class="text-xl font-semibold text-gray-700">Modern</h3>
            <p class="mt-2 text-gray-600">Built with the latest technologies.</p>
        </div>
    </div>
</section>
</body>
</html>
