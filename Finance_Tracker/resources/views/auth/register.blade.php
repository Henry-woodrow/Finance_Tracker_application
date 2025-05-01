<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body class="bg-gradient-to-br from-gray-900 to-gray-700 text-white min-h-screen pt-24">
    @include('layouts.navigation')

    <div class="container max-w-full mx-auto px-6">
        <div class="max-w-md mx-auto bg-gray-800 rounded-xl shadow-lg p-8">
            <h2 class="text-3xl font-bold text-center mb-6">Register</h2>

            <form method="POST" action="{{ route('register') }}" x-data="{ password: '', password_confirm: '' }">
                @csrf
                <div class="space-y-4">

                    <!-- email -->
                    <div>
                        <label class="block text-sm text-gray-300 mb-1">Email</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Username" required
                            class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- email second time -->
                    <div>
                        <label class="block text-sm text-gray-300 mb-1">Confirm Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required
                            class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">User already exists</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm text-gray-300 mb-1">Password</label>
                        <input type="password" name="password" x-model="password" placeholder="Password" required
                            class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-sm text-gray-300 mb-1">Confirm Password</label>
                        <input type="password" name="password_confirmation" x-model="password_confirm" placeholder="Confirm Password" required
                            class="w-full px-4 py-2 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- Live Validation -->
                    <div class="text-sm space-y-2 text-white">
                        <template x-for="(rule, index) in [
                            { label: 'Passwords match', valid: password === password_confirm && password.length },
                            { label: 'At least 8 characters', valid: password.length >= 8 },
                            { label: 'Contains uppercase letter', valid: /[A-Z]/.test(password) },
                            { label: 'Contains lowercase letter', valid: /[a-z]/.test(password) },
                            { label: 'Contains number', valid: /[0-9]/.test(password) },
                            { label: 'Contains special character', valid: /[\W_]/.test(password) },
                        ]">
                            <div class="flex items-center gap-2" :class="rule['valid'] ? 'text-green-400' : 'text-red-400'">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path x-show="rule.valid" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    <path x-show="!rule.valid" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                <span x-text="rule.label"></span>
                            </div>
                        </template>
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg shadow-lg transition">
                        Register
                    </button>
                </div>
            </form>

            <div class="text-sm text-center text-gray-300 mt-6">
                Already have an account?
                <a href="{{ route('login') }}" class="text-blue-400 hover:underline">Login</a>
            </div>
        </div>
    </div>
</body>
</html>
