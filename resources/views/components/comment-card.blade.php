<x-card class="mb-4">
    <h2 class="mb-2 text-xl font-semibold">{{ $comment->user->name }}</h2>

    <p class="mb-4">{{ $comment->content }}</p>

    <div class="ml-8">
        {{ $slot }}
    </div>
</x-card>