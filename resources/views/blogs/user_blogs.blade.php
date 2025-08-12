@extends('Layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-5xl mx-auto px-4">
        
        {{-- Page Heading --}}
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-3xl font-bold text-gray-800">My Blogs</h1>
            <div class="flex gap-3">
                <a href="{{ route('blogs.create') }}"
                   class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Create New Blog
                </a>
                <a href="{{ route('blogs.index') }}"
                   class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg shadow hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400">
                    Back to All Blogs
                </a>
            </div>
        </div>

        {{-- Blog List --}}
        @if($blogs->isEmpty())
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <p class="text-gray-500 text-lg">No blogs found.</p>
            </div>
        @else
            <div class="grid gap-6 md:grid-cols-2">
                @foreach($blogs as $blog)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition p-6 flex flex-col">
                        {{-- Title --}}
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">
                            {{ $blog->title }}
                        </h2>

                        {{-- Content Preview --}}
                        <p class="text-gray-600 text-sm flex-grow">
                            {{ Str::limit($blog->content, 120, '...') }}
                        </p>

                        {{-- Metadata --}}
                        <div class="mt-4 text-gray-500 text-xs">
                            <p><strong>Author:</strong> {{ $blog->user->name }}</p>
                            <p><strong>Published at:</strong> {{ $blog->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection
