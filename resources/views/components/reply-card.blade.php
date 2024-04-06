<x-card {{ $attributes->class(['rounded-md border border-green-700 bg-white shadow-sm mb-2 p-2']) }}>
    <div class="flex items-center space-x-4 mb-4">
        <img src="{{ $reply->user->avatar }}" alt="{{ $reply->user->name }}" class="w-10 h-10 rounded-full">
        <div>
            <h3 class="font-semibold">{{ $reply->user->name }}</h3>
            <p class="text-gray-600 text-sm">{{ $reply->created_at->diffForHumans() }}</p>
        </div>
    </div>

    <p class="text-sm">{{ $reply->content }}</p>

    {{ $slot }}
</x-card>