@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-md mx-auto">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="px-6 py-4 bg-green-600">
                <h2 class="text-xl font-bold text-white">Reset Password</h2>
            </div>

            <div class="p-6">
                @if (session('status'))
                <div class="mb-6 text-sm bg-green-50 text-green-600 p-4 rounded-lg border border-green-200">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="font-medium">Reset Link Sent Successfully!</span>
                    </div>
                    <p>Please check your email for the password reset link. You can request another link in 60 seconds.</p>
                </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" id="resetForm">
                    @csrf

                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 @error('email') border-red-500 @enderror">

                        @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" id="submitBtn"
                            class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                            Send Reset Link
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@if(session('status'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const submitBtn = document.getElementById('submitBtn');
        const form = document.getElementById('resetForm');
        let timeLeft = 60;

        submitBtn.disabled = true;

        const timer = setInterval(() => {
            timeLeft--;
            submitBtn.textContent = `Wait ${timeLeft}s`;

            if (timeLeft <= 0) {
                clearInterval(timer);
                submitBtn.disabled = false;
                submitBtn.textContent = 'Send Reset Link';
            }
        }, 1000);
    });
</script>
@endif
@endsection