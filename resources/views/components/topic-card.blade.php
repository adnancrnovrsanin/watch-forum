<x-card class="mb-4">
    <div class="flex items-center space-x-4 mb-4">
        <img src="{{ $topic->user->avatar }}" alt="{{ $topic->user->name }}" class="w-12 h-12 rounded-full">
        <div>
            <h3 class="font-semibold">{{ $topic->user->name }}</h3>
            <p class="text-gray-600 text-sm">{{ $topic->created_at->diffForHumans() }}</p>
        </div>
    </div>

    <h2 class="mb-4 text-xl font-semibold">{{ $topic->name }}</h2>

    <p class="mb-4 text-gray-600">{{ $topic->description }}</p>

    {{ $slot }}
</x-card>