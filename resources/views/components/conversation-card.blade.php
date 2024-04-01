<x-card class="mb-4">
    <h2 class="mb-4 text-xl font-semibold">{{ $conversation->title }}</h2>

    <p class="mb-4 text-gray-600">{{ $conversation->description }}</p>

    {{ $slot }}
</x-card>