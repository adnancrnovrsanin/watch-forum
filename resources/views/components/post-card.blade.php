<x-card class="mb-4">
    <div class="flex items-center space-x-4 mb-4">
        <img src="{{ $post->topic->user->avatar }}" alt="{{ $post->topic->user->name }}" class="w-12 h-12 rounded-full">
        <div>
            <h3 class="font-semibold">{{ $post->topic->user->name }}</h3>
            <p class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</p>
        </div>
    </div>

    <h2 class="mb-4 text-xl font-semibold">{{ $post->title }}</h2>

    <p class="mb-4 text-gray-600">{{ Str::limit($post->content, 100) }}</p>

    {{ $slot }}
</x-card>