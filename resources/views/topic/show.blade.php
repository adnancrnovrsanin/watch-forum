<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Topics' => route('topics.index'), $topic->name => '#']" />
    <x-topic-card :$topic>
    </x-topic-card>

    <x-card class="mb-4">
        <h2 class="mb-10 mt-2 text-xl font-medium">
            Conversations about {{ $topic->name }}
        </h2>

        @foreach ($topic->conversations as $conversation)
        <x-conversation-card class="mb-4" :$conversation>
            <x-link-button :href="route('conversations.show', $conversation)">
                Show conversation
            </x-link-button>
        </x-conversation-card>
        @endforeach
    </x-card>
</x-layout>