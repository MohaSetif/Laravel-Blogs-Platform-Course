@extends('Layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-10 px-4 flex items-center justify-center relative">
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

    {{-- Notifications container --}}
    <div id="notifications" class="fixed top-5 right-5 space-y-3 z-50"></div>
</div>
@endsection

@push('scripts')
<script>
    import './bootstrap';

    window.Echo.channel('blogNotification')
        .listen('BlogCreated', (e) => {
            showNotification(`📝 New Blog Created: "${e.blog.title}"`);
        });

    function showNotification(message) {
        const container = document.getElementById('notifications');

        // Create notification div
        const notif = document.createElement('div');
        notif.className = "bg-white border border-gray-200 shadow-lg rounded-lg p-4 flex items-center justify-between animate-slide-in";
        notif.innerHTML = `
            <span class="text-gray-800">${message}</span>
            <button class="ml-4 text-gray-400 hover:text-gray-600">&times;</button>
        `;

        // Close on click
        notif.querySelector('button').onclick = () => notif.remove();

        // Auto-remove after 5s
        setTimeout(() => notif.remove(), 5000);

        container.appendChild(notif);
    }
</script>

<style>
    @keyframes slide-in {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    .animate-slide-in {
        animation: slide-in 0.3s ease-out;
    }
</style>
@endpush
