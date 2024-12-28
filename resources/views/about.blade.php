@extends('layouts.app')

@section('content')
<div class="hero-section text-white relative py-24">
    <div class="container mx-auto px-4">
        <h1 class="text-5xl font-bold mb-6">About Compronians 86/92 COOP</h1>
        <p class="text-xl max-w-2xl">Empowering members through financial cooperation since 1986</p>
    </div>
    <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white"></div>
</div>

<div class="container mx-auto px-4 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
        <div class="space-y-8">
            <div class="transform hover:scale-105 transition duration-300">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
                    <span class="bg-green-100 p-2 rounded-full mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </span>
                    Our Mission
                </h2>
                <div class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-green-600">
                    <p class="text-lg text-gray-700 leading-relaxed">
                        To empower our members through innovative financial solutions, fostering economic growth and prosperity within our community through cooperative savings and accessible loans.
                    </p>
                </div>
            </div>

            <div class="transform hover:scale-105 transition duration-300">
                <h2 class="text-3xl font-bold text-gray-900 mb-6 flex items-center">
                    <span class="bg-green-100 p-2 rounded-full mr-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </span>
                    Our Vision
                </h2>
                <div class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-green-600">
                    <p class="text-lg text-gray-700 leading-relaxed">
                        To be the leading cooperative society, recognized for excellence in financial services, member satisfaction, and community development, setting the standard for cooperative operations in Nigeria.
                    </p>
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-lg border-t-4 border-green-600">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Our Core Values</h2>
            <div class="space-y-8">
                <div class="flex items-start space-x-4 transform hover:scale-105 transition duration-300">
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Integrity</h3>
                        <p class="text-gray-600">Upholding the highest standards of honesty, transparency, and ethical conduct in all our operations.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4 transform hover:scale-105 transition duration-300">
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Innovation</h3>
                        <p class="text-gray-600">Embracing technological advancements and creative solutions to enhance member services and experience.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4 transform hover:scale-105 transition duration-300">
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Member-Focused</h3>
                        <p class="text-gray-600">Putting our members first, ensuring their financial growth and success through personalized services.</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4 transform hover:scale-105 transition duration-300">
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Financial Excellence</h3>
                        <p class="text-gray-600">Maintaining prudent financial management and sustainable growth for long-term stability.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-green-50 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Join Our Thriving Community</h2>
            <p class="text-xl text-gray-600 mb-8">Experience the power of cooperative operations with Compronians 86/92</p>
            <a href="{{ route('register') }}" class="inline-block bg-green-600 text-white px-8 py-4 rounded-lg hover:bg-green-700 font-semibold transition duration-300">
                Become a Member Today
            </a>
        </div>
    </div>
</div>

<style>
    .hero-section {
        background: linear-gradient(rgba(0, 128, 0, 0.9), rgba(0, 128, 0, 0.8)), url('/images/hero-bg.jpg');
        background-size: cover;
        background-position: center;
    }
</style>
@endsection