<nav class="bg-green-600 border-b border-green-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <img class="h-8 w-auto" src="{{ asset('images/logo.png') }}" alt="COOP8692">
                    </a>
                </div>

                Navigation Links
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="{{ route('home') }}" class="text-white hover:text-gray-200 px-3 py-2 rounded-md text-sm font-medium">Home</a>
                    <a href="{{ route('about') }}" class="text-white hover:text-gray-200 px-3 py-2 rounded-md text-sm font-medium">About</a>
                </div>
            </div>

            <!-- Authentication Links -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @guest
                    <a href="{{ route('login') }}" class="text-white hover:text-gray-200 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                    <a href="{{ route('register') }}" class="bg-white text-green-700 hover:bg-gray-100 ml-4 px-3 py-2 rounded-md text-sm font-medium">Register</a>
                @else
                    <!-- Add authenticated user menu here -->
                @endguest
            </div>
        </div>
    </div>
</nav>
