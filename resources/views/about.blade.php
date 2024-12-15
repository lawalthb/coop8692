@extends('layouts.app')

@section('content')
<div class="bg-green-600 text-white py-20">
    <div class="container mx-auto px-4">
        <h1 class="text-5xl font-bold mb-6">About COOP8692</h1>
        <p class="text-xl">Building a stronger financial future together</p>
    </div>
</div>

<div class="container mx-auto px-4 py-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
        <div class="space-y-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Mission</h2>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <p class="text-lg text-gray-700 leading-relaxed">
                        To empower our members through innovative financial solutions, fostering economic growth and prosperity within our community through cooperative savings and accessible loans.
                    </p>
                </div>
            </div>

            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Vision</h2>
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <p class="text-lg text-gray-700 leading-relaxed">
                        To be the leading cooperative society, recognized for excellence in financial services, member satisfaction, and community development, setting the standard for cooperative banking in Nigeria.
                    </p>
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Core Values</h2>
            <div class="bg-white p-8 rounded-lg shadow-lg">
                <div class="space-y-6">
                    <div class="flex items-start space-x-4">
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Integrity</h3>
                            <p class="text-gray-600">Maintaining the highest standards of honesty and transparency in all our dealings</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Innovation</h3>
                            <p class="text-gray-600">Continuously improving our services to meet evolving member needs</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Member-Focused</h3>
                            <p class="text-gray-600">Prioritizing member satisfaction and financial well-being</p>
                        </div>
                    </div>

                    <div class="flex items-start space-x-4">
                        <div class="bg-green-100 p-3 rounded-full">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Financial Responsibility</h3>
                            <p class="text-gray-600">Ensuring sustainable growth and prudent management of resources</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-green-50 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Join Our Growing Community</h2>
            <p class="text-xl text-gray-600 mb-8">Experience the benefits of being part of a forward-thinking cooperative society</p>
            <a href="{{ route('register') }}" class="inline-block bg-green-600 text-white px-8 py-4 rounded-lg hover:bg-green-700 font-semibold transition duration-300">Become a Member Today</a>
        </div>
    </div>
</div>
@endsection
