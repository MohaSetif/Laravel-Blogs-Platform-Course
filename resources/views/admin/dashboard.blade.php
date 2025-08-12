@extends('Layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-10 px-4 flex items-center justify-center">
    <div class="max-w-4xl w-full bg-white rounded-xl shadow-lg p-8">
        
        {{-- Heading --}}
        <h1 class="text-4xl font-bold text-gray-800 mb-2 text-center">Admin Dashboard</h1>
        <p class="text-gray-500 text-center mb-8">Manage and review blog submissions</p>

        {{-- Blogs List --}}
        @if($blogs->isEmpty())
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
                <p class="text-gray-500">No blogs available for review.</p>
            </div>
        @else
            <div class="space-y-6">
                @foreach($blogs as $blog)
                    <div class="border border-gray-200 rounded-lg p-6 shadow-sm hover:shadow-md transition">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $blog->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ $blog->content }}</p>

                        <form action="{{ route('admin.updateBlogStatus', $blog->id) }}" method="POST" class="flex gap-4">
                            @csrf
                            @method('PUT')

                            <button type="submit" name="status" value="published" 
                                class="flex-1 bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition">
                                Publish
                            </button>

                            <button type="submit" name="status" value="rejected" 
                                class="flex-1 bg-red-500 text-white py-2 rounded-lg hover:bg-red-600 transition">
                                Reject
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
