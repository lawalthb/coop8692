<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - Member Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @stack('styles')

</head>

<body class="bg-gray-100">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen flex flex-col">
        <!-- Top Navigation -->
        <nav class="bg-green-600 fixed w-full z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <button @click="sidebarOpen = !sidebarOpen" class="text-white p-2 rounded-md lg:hidden">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path x-show="!sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                <path x-show="sidebarOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                        <div class="flex items-center">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 w-auto">
                            <span class="text-white text-xl font-bold ml-3">COOP8692</span>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center space-x-4 text-white hover:text-green-100">
                                <img class="h-8 w-8 rounded-full object-cover"
                                    src="{{ auth()->user()->member_image ? asset('storage/' . auth()->user()->member_image) : asset('images/avatar.png') }}"
                                    alt="Profile">
                                <div class="hidden md:block text-left">
                                    <p class="text-sm font-semibold">{{ Auth::user()->full_name }}</p>
                                    <p class="text-xs text-green-100">Member</p>
                                </div>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" @click.away="open = false"
                                class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                <div class="border-t border-gray-100"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                        Sign out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="flex flex-1 pt-16">
            <!-- Sidebar -->
            <aside x-cloak :class="{'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen}"
                class="fixed inset-y-0 left-0 z-40 w-64 bg-white shadow-lg transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0">
                <div class="h-full overflow-y-auto">
                    <nav class="px-4 py-4">
                        <div class="space-y-4">
                            <a href="{{ route('member.dashboard') }}"
                                class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700
                                {{ request()->routeIs('member.dashboard') ? 'bg-green-50 text-green-700' : '' }}">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Dashboard
                            </a>
                            <div class="pt-4">
                                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Management</p>
                                <div class="mt-3 space-y-1">




                                    <a href="{{ route('member.savings.index') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('member.savings.*') ? 'bg-green-50 text-green-700' : '' }}">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2z"></path>
                                        </svg>

                                        Savings
                                    </a>



                                    <a href="{{ route('member.loans.index') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('member.loans.*') ? 'bg-green-50 text-green-700' : '' }}">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        Loans
                                    </a>
                                    <a href="{{ route('member.loan.calculator') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('member.loan.calculator') ? 'bg-green-50 text-green-700' : '' }}">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                        </svg>
                                        Loan Calculator
                                    </a>

                                    <a href="{{ route('member.resources.index') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('member.resources.*') ? 'bg-green-50 text-green-700' : '' }}">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                        Resources
                                    </a>
                                    <a href="{{ route('member.notifications.index') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('member.notifications.*') ? 'bg-green-50 text-green-700' : '' }}">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                        </svg>
                                        Notifications
                                        @if(auth()->user()->unreadNotifications->count() > 0)
                                        <span class="ml-2 bg-red-500 text-red text-xs px-2 py-1 rounded-full">
                                            {{ auth()->user()->unreadNotifications->count() }}
                                        </span>
                                        @endif
                                    </a>
                                    <a href="{{ route('member.loans.guarantor-requests') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('member.loans.guarantor-requests') ? 'bg-green-50 text-green-700' : '' }}">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                        </svg>
                                        Guarantor Requests
                                        @php
                                        $pendingCount = \App\Models\LoanGuarantor::where('user_id', auth()->id())
                                        ->where('status', 'pending')
                                        ->count();
                                        @endphp
                                        @if($pendingCount > 0)
                                        <span class="ml-2 px-2 py-1 text-xs bg-red-500 text-white rounded-full">
                                            {{ $pendingCount }}
                                        </span>
                                        @endif
                                    </a>
                                    <a href="{{ route('member.transactions.index') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('member.transactions.*') ? 'bg-green-50 text-green-700' : '' }}">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                        </svg>
                                        Transactions
                                    </a>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider">Settings</p>
                                <a href="{{ route('member.profile.index') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700 {{ request()->routeIs('member.profile.*') ? 'bg-green-50 text-green-700' : '' }}">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Profile
                                </a>
                                <!-- Add Logout Link -->
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="flex w-full items-center px-4 py-3 text-gray-700 rounded-lg hover:bg-green-50 hover:text-green-700">
                                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        Sign Out
                                    </button>
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 min-w-0 overflow-hidden">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    @if(session('success'))
                    <div class="mb-8 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if(session('error'))
                    <div class="mb-8 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        {{ session('error') }}
                    </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>

        <!-- Mobile Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 z-30 bg-gray-600 opacity-75 lg:hidden">
        </div>
    </div>

    @stack('scripts')
</body>

</html>

<!-- Add this in the head section -->
