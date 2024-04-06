<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Topics' => route('topics.index'), $topic->name => route('topics.show', ['topic' => $topic]), $conversation->title => '#']" />
    <x-conversation-card :$conversation>
        @can('update', $conversation)
        <x-link-button :href="route('conversations.edit', $conversation)">
            Edit this conversation
        </x-link-button>
        @endcan
    </x-conversation-card>

    @can('create', App\Models\Comment::class)
    <x-card class="mb-4">
        <h1 class="mb-4 font-medium text-lg">
            Add a comment:
        </h1>
        <form action="{{ route('conversation.comments.store', $conversation) }}" method="POST">
            @csrf

            <div class="mb-8">
                <x-text-input name="content" class="w-full" type="textarea" placeholder="Write a comment..." />
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
        <h2 class="mb-4 text-lg font-medium">
            Comments about {{ $conversation->title }}:
        </h2>

        <!-- TODO: Add conversation comments here -->
        @foreach ($conversation->comments->sortByDesc('created_at') as $comment)
        <x-comment-card class="mb-4" :$comment>
            @can('create', App\Models\Reply::class)
            <form action="{{ route('comment.replies.store', $comment) }}" method="POST" class="w-1/2 flex flex-col my-8">
                @csrf
                <x-text-input name="content" placeholder="Write a reply..." type="textarea" />

                <x-button class="font-medium text-sm w-fit self-end py-0.5">Reply</x-button>
            </form>
            @else
            <p class="font-bold text-slate-400 my-8">
                Log in so you can join in on this disscussion
            </p>
            @endcan
            @foreach ($comment->replies->sortByDesc('updated_at') as $reply)
            <x-reply-card class="mb-4 w-fit ml-12" :$reply />
            @endforeach
        </x-comment-card>
        @endforeach
    </x-card>
</x-layout>