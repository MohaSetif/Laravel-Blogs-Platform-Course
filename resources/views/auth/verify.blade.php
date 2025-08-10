@extends('Layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center py-10">
    <div class="max-w-lg bg-white rounded-lg shadow-lg p-8 text-center">
        
        {{-- Heading --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Verify Your Email Address</h1>

        {{-- Message --}}
        <p class="text-gray-600 mb-6">
            Thanks for signing up! Before getting started, please verify your email address by clicking on the link we just emailed to you.
        </p>

        {{-- Resend form --}}
        <form action="{{ route('verification.send') }}" method="POST" class="space-y-4">
            @csrf
            <button type="submit"
                class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Resend Verification Email
            </button>
        </form>

    </div>
</div>
@endsection
