<x-card {{ $attributes->class(['rounded-md border border-green-700 bg-white p-4 shadow-sm mb-2 p-2']) }}>
    <h2 class="mb-2 font-semibold">{{ $reply->user->name }}</h2>

    <p class="text-sm">{{ $reply->content }}</p>

    {{ $slot }}
</x-card>