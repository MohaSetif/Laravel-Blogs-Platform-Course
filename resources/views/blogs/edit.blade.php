@extends('Layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center py-10">
    <div class="w-full max-w-2xl bg-white shadow-lg rounded-lg p-8">
        
        <h1 class="text-3xl font-bold mb-6 text-gray-800">
            Edit Blog ID: {{ $blog->id }}
        </h1>

        {{-- Error messages --}}
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-100 border border-red-300 rounded-lg text-red-700">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Edit form --}}
        <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" id="title" name="title" 
                    value="{{ old('title', $blog->title) }}" required
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none border-gray-300">
            </div>

            {{-- Content --}}
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                <textarea id="content" name="content" rows="6" required
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none border-gray-300 resize-none">{{ old('content', $blog->content) }}</textarea>
            </div>

            {{-- Image --}}
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Image</label>
                <input type="file" id="image" name="image"
                    class="w-full text-gray-700 border border-gray-300 rounded-lg file:mr-4 file:py-2 file:px-4
                    file:rounded-full file:border-0 file:text-sm file:font-semibold
                    file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

                @if($blog->image)
                    <div class="mt-4">
                        <img src="{{ asset('storage/' . $blog->image) }}" alt="Blog Image" class="max-w-xs rounded-lg shadow">
                    </div>
                @endif
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-600 text-white px-6 py-2 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Update
                </button>
                <a href="{{ route('blogs.index') }}"
                    class="text-gray-600 hover:text-blue-600 transition">
                    Back to Blogs
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
