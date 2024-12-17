@extends('layouts.app')
@section('content')
<div class="hero-section text-white relative">
    <div class="container mx-auto px-4 py-10">
        <div class="flex items-center justify-between">
            <div class="max-w-3xl">
                <h1 class="text-6xl font-bold mb-6 leading-tight">Welcome to '86/'92 of Compronians</h1>
                <p class="text-xl mb-12 leading-relaxed">86/92 cooperative society charter.</p>
                <div class="space-x-6">
                    <a href="{{ route('login') }}" class="bg-white text-green-700 px-8 py-4 rounded-lg hover:bg-gray-100 font-semibold transition duration-300">Login</a>
                    <a href="/about" class="border-2 border-white text-white px-8 py-4 rounded-lg hover:bg-white hover:text-green-700 font-semibold transition duration-300">Know More</a>
                </div>
            </div>
            <div class="hidden md:block">
                <video
                    class="w-96 rounded-lg shadow-xl border-4 border-white"
                    autoplay
                    loop
                    muted
                    playsinline
                >
                    <source src="{{ asset('images/vid.mp4') }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white"></div>
</div>
<div class="py-10 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Why Choose <br /> 86/92 cooperative society charter?</h2>
            <p class="text-xl text-gray-600">Experience the benefits of our comprehensive financial services</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="text-center p-8 bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Competitive Savings</h3>
                <p class="text-gray-600">Earn attractive returns on your savings with our flexible savings plans tailored to your goals</p>
            </div>

            <div class="text-center p-8 bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Quick Loans</h3>
                <p class="text-gray-600">Access affordable loans with competitive interest rates and flexible repayment terms</p>
            </div>

            <div class="text-center p-8 bg-white rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Strong Community</h3>
                <p class="text-gray-600">Join a network of professionals committed to mutual growth and financial success</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-green-50 py-24">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-900 mb-8">Ready to Start Your Journey?</h2>
            <p class="text-xl text-gray-600 mb-12">Join COOP8692 today and take the first step towards financial freedom</p>
            <a href="{{ route('register') }}" class="inline-block bg-green-600 text-white px-8 py-4 rounded-lg hover:bg-green-700 font-semibold transition duration-300">Become a Member</a>
        </div>
    </div>
</div>

<style>
    .hero-section {
        background: linear-gradient(rgba(0, 128, 0, 0.9), rgba(0, 128, 0, 0.8)), url('/images/hero-bg.jpg');
        background-size: cover;
        background-position: center;
        min-height: 400px;
    }
</style>
@endsection
