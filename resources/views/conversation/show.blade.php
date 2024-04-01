<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Topics' => route('topics.index'), $topic->name => route('topics.show', ['topic' => $topic]), $conversation->title => '#']" />
    <x-conversation-card :$conversation>
    </x-conversation-card>

    <x-card class="mb-4">
        <h2 class="mb-4 text-lg font-medium">
            Comments about {{ $conversation->title }}:
        </h2>

        <!-- TODO: Add conversation comments here -->
        @foreach ($conversation->comments as $comment)
        <x-comment-card class="mb-4" :$comment>
            @foreach ($comment->replies as $reply)
            <x-reply-card class="mb-4" :$reply>

            </x-reply-card>
            @endforeach
        </x-comment-card>
        @endforeach
    </x-card>
</x-layout>