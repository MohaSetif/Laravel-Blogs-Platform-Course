@extends('Layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-8">
        
        {{-- Blog Title --}}
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $blog->title }}</h1>

        {{-- Blog Image --}}
        @if($blog->image)
            <div class="mb-6">
                <img src="{{ asset('storage/' . $blog->image) }}" 
                     alt="Blog Image" 
                     class="w-full max-h-96 object-cover rounded-lg shadow">
            </div>
        @endif

        {{-- Blog Content --}}
        <p class="text-gray-700 leading-relaxed mb-6">
            {{ $blog->content }}
        </p>

        {{-- Actions --}}
        <div class="flex items-center gap-4">
            <a href="{{ route('blogs.edit', $blog->id) }}"
               class="bg-blue-600 text-white px-5 py-2 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Edit
            </a>
            <a href="{{ route('blogs.index') }}"
               class="text-gray-600 hover:text-blue-600 transition">
                ← Back to Blogs
            </a>
        </div>
    </div>
</div>
@endsection
