<!doctype html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    @vite('resources/css/app.css')

  </head>
<header>
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
          <a href="#" class="text-2xl font-bold">My Website</a>

          <!-- Hamburger Icon -->
          <button id="menu-toggle" class="md:hidden focus:outline-none">
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
          </button>

          <!-- Nav Links -->
          <div id="menu" class="hidden md:flex space-x-6">
            <a href="#" class="hover:text-blue-300">Home</a>
            <a href="#about" class="hover:text-blue-300">About</a>
            <a href="/login" class="hover:text-blue-300">login</a>
            <a href="/register" class="hover:text-blue-300">SignUp</a>
          </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden flex flex-col bg-blue-700 text-white p-4 space-y-2">
          <a href="#" class="hover:text-blue-300">Home</a>
          <a href="#about" class="hover:text-blue-300">About</a>
          <a href="#services" class="hover:text-blue-300">Services</a>
          <a href="#contact" class="hover:text-blue-300">Contact</a>
        </div>
      </nav>
      <script src="/src/main.js"></script>
</header>
</html>
