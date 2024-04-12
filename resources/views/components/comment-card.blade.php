<x-card class="mb-4">
    <div class="flex items-center space-x-6">
        <div class="flex flex-col items-center space-y-1">
            <form action="{{ route("comments.vote", $comment) }}" method="POST">
                @csrf
                <input type="hidden" name="vote" value="1">
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" @class([ 'w-8 h-8 cursor-pointer rounded-full hover:text-white hover:bg-green-700' , 'bg-green-700 text-white'=> ($comment->hasVoted(auth()->user()) && $comment->userVote(auth()->user()) == 1),
                        ])
                        >
                        <path stroke-linecap="round" stroke-linejoin="round" d="m15 11.25-3-3m0 0-3 3m3-3v7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </button>
            </form>

            <p class="font-medium text-lg">
                {{ $comment->voteSum() }}
            </p>

            <form action="{{ route('comments.vote', $comment) }}" method="POST">
                @csrf
                <input type="hidden" name="vote" value="-1">
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" @class([ 'w-8 h-8 cursor-pointer rounded-full hover:text-white hover:bg-red-700' , 'bg-red-700 text-white'=> $comment->userVote(auth()->user()) == -1,
                        ])
                        >
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9 12.75 3 3m0 0 3-3m-3 3v-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </button>
            </form>
        </div>

        <div class="flex flex-col justify-center">
            <div class="flex items-center space-x-4 mb-4">
                <img src="{{ $comment->user->avatar }}" alt="{{ $comment->user->name }}" class="w-12 h-12 rounded-full">
                <div>
                    <div class="flex items-center space-x-2">
                        <h3 class="font-semibold text-lg">{{ $comment->user->name }}</h3>
                        @if ($comment->conversation->topic->isBlockedBy($comment->user))
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-red-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                        </svg>
                        @endif

                        @if (auth()->user()->can('block', $comment->conversation->topic) && !$comment->conversation->topic->isBlockedBy($comment->user) && auth()->user()->id != $comment->user->id)
                        <form action="{{ route('topics.user.blockUser', ['topic' => $comment->conversation->topic, 'user' => $comment->user]) }}" method="POST">
                            @csrf
                            <button class="p-2 rounded-full hover:bg-slate-100">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                                </svg>
                            </button>
                        </form>
                        @endif
                    </div>
                    <p class="text-gray-600 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                </div>
            </div>

            <p class="mb-4">{{ $comment->content }}</p>
        </div>
    </div>

    <div class="ml-8">
        {{ $slot }}
    </div>
</x-card>