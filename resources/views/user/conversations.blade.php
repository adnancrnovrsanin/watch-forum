<x-layout>
    @if ($conversations->isEmpty())
    <p class="text-lg font-semibold mt-4">You didn't create a conversation yet.</p>
    @else
    <x-card class="mb-4">
        <h2 class="mb-10 mt-2 text-xl font-medium">
            Conversations about {{ $conversations->first()->topic->name }}
        </h2>

        @foreach ($conversations->sortByDesc('updated_at') as $conversation)
        <x-conversation-card class="mb-4" :$conversation>
            <x-link-button :href="route('conversations.show', $conversation)">
                Show conversation
            </x-link-button>
        </x-conversation-card>
        @endforeach
    </x-card>
    @endif
</x-layout>