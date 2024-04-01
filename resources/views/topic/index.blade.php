<x-layout>
    <h2 class="text-3xl font-medium my-6">See what interests you from these topics</h2>

    @foreach ($topics as $topic)
    <x-topic-card class="mb-4" :$topic>
        <x-link-button :href="route('topics.show', $topic)">
            Show conversations from this topic
        </x-link-button>
    </x-topic-card>
    @endforeach
</x-layout>