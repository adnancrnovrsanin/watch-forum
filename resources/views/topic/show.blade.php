<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Topics' => route('topics.index'), $topic->name => '#']" />
    <x-topic-card :$topic />

    @can('create', App\Models\Conversation::class)
    <x-card class="mb-4">
        <h1 class="mb-4 font-medium text-lg">
            Create a conversation about this topic
        </h1>
        <form action="{{ route('conversations.store', $topic) }}" method="POST">
            @csrf
            <div class="mb-8">
                <x-label for="title" :required="true">Title</x-label>
                <x-text-input name="title" class="w-full" />
            </div>

            <div class="mb-8">
                <x-label for="description" :required="true">Description</x-label>
                <x-text-input name="description" class="w-full" type="textarea" />
            </div>

            <x-button class="w-full font-medium">Submit</x-button>
        </form>
    </x-card>
    @else
    <x-card class="mb-4">
        <p class="font-bold text-slate-400">
            Log in so you can create a conversation about this topic.
        </p>
    </x-card>
    @endcan

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