<x-layout>
    <div class="flex items-center justify-between w-full">
        <h2 class="text-3xl font-medium my-6">See what interests you from these topics</h2>

        @can('create', App\Models\Topic::class)
        <x-link-button class="text-base" :href="route('topics.create')">
            Create a new topic
        </x-link-button>
        @endcan
    </div>

    @foreach ($topics as $topic)
    <x-topic-card class="mb-4" :$topic>
        <x-link-button :href="route('topics.show', $topic)">
            Show conversations from this topic
        </x-link-button>
    </x-topic-card>
    @endforeach
</x-layout>