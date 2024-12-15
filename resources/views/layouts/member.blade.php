<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Member Portal</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-green-600">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="flex-shrink-0 flex items-center">
                        <span class="text-white text-xl font-bold">COOP8692</span>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="{{ route('member.dashboard') }}" class="text-white hover:text-green-100 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                        <a href="{{ route('member.savings') }}" class="text-white hover:text-green-100 px-3 py-2 rounded-md text-sm font-medium">Savings</a>
                        <a href="{{ route('member.loans') }}" class="text-white hover:text-green-100 px-3 py-2 rounded-md text-sm font-medium">Loans</a>
                        <a href="{{ route('member.profile') }}" class="text-white hover:text-green-100 px-3 py-2 rounded-md text-sm font-medium">Profile</a>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="ml-3 relative">
                        <div class="flex items-center space-x-4">
                            <span class="text-white">{{ auth()->user()->full_name }}</span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-white hover:text-green-100 px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t mt-8">
        <div class="max-w-7xl mx-auto py-6 px-4">
            <p class="text-center text-gray-500 text-sm">
                © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
            </p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
