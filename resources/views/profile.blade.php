@extends('Layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-lg mx-auto bg-white rounded-lg shadow-lg p-8 text-center">
        
        {{-- Profile Heading --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-4">My Profile</h1>
        <h2 class="text-xl text-gray-600 mb-6">
            Welcome, <span class="font-semibold">{{ Auth::user()->name }}</span>!
        </h2>

        {{-- User Info --}}
        <div class="mb-6">
            <p class="text-gray-700">
                <span class="font-medium">Email:</span> {{ Auth::user()->email }}
            </p>
        </div>

        {{-- Navigation Links --}}
        <div class="space-y-4">
            <a href="{{ route('blogs.index') }}"
               class="block bg-blue-600 text-white py-2 px-4 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                View Blogs
            </a>

            <a href ="{{ route('blogs.user', Auth::user()) }}" 
               class="block bg-green-600 text-white py-2 px-4 rounded-lg shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                My Blogs
            </a>

            <form action="{{ route('logout') }}" method="POST" class="inline-block">
                @csrf
                <button type="submit"
                        class="bg-red-600 text-white py-2 px-4 rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                    Logout
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
