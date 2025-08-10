@extends('Layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center py-10">
    <div class="max-w-md w-full bg-white rounded-lg shadow-lg p-8 text-center">
        
        {{-- Heading --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Dashboard</h1>

        {{-- Logout Form --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="bg-red-600 text-white px-6 py-2 rounded-lg shadow hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                Logout
            </button>
        </form>

    </div>
</div>
@endsection
