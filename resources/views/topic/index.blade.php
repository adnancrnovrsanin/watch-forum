<x-layout>
    <div class="flex items-center justify-between w-full">
        <h2 class="text-3xl font-medium my-6">See what interests you</h2>

        @can('create', App\Models\Topic::class)
        <x-link-button class="text-base" :href="route('topics.create')">
            Create a new topic
        </x-link-button>
        @endcan
    </div>

    @auth
    <h3 class="text-2xl font-medium my-6">Topics you follow</h3>
    @if ($userFollowedTopics->count() > 0)
    @foreach ($userFollowedTopics as $topic)
    <x-topic-card class="mb-4" :$topic>
        <x-link-button :href="route('topics.show', $topic)">
            See details
        </x-link-button>
    </x-topic-card>
    @endforeach
    @else
    <p class="text-lg">You haven't followed any topics yet.</p>
    @endif

    <h3 class="text-2xl font-medium my-6">Explore new topics</h3>
    @foreach ($topics->reject(fn ($topic) => $userFollowedTopics->contains($topic)) as $topic)
    <x-topic-card class="mb-4" :$topic>
        <x-link-button :href="route('topics.show', $topic)">
            See details
        </x-link-button>
    </x-topic-card>
    @endforeach
    @else
    @foreach ($topics->sortByDesc('updated_at') as $topic)
    <x-topic-card class="mb-4" :$topic>
        <x-link-button :href="route('topics.show', $topic)">
            See details
        </x-link-button>
    </x-topic-card>
    @endforeach
    @endauth
</x-layout>