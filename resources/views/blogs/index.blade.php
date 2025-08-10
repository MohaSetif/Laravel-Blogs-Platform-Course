@extends('Layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <div class="max-w-4xl mx-auto px-4">
        
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Here are our blogs!</h1>

        <a href="{{ route('blogs.create') }}" 
           class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-6">
            Create New Blog
        </a>

        @if($blogs->count())
            <div class="grid mt-12 gap-6 sm:grid-cols-2">
                @foreach($blogs as $blog)
                    <div class="bg-white shadow-md rounded-lg p-6 hover:shadow-lg transition">
                        <h2 class="text-xl font-semibold text-gray-800 mb-2">
                            <a href="{{ route('blogs.show', $blog->id) }}" 
                               class="hover:text-blue-600 transition">
                                {{ $blog->title }}
                            </a>
                        </h2>
                        <p class="text-gray-600 text-sm">
                            {{ Str::limit($blog->content, 100, '...') }}
                        </p>
                        <div class="mt-4">
                            <a href="{{ route('blogs.show', $blog->id) }}" 
                               class="text-blue-600 hover:underline font-medium">
                                Read More →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white p-6 rounded-lg shadow text-center">
                <p class="text-gray-500 text-lg">No blogs available.</p>
            </div>
        @endif

    </div>
</div>
@endsection
