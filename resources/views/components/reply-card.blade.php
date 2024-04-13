<x-card {{ $attributes->class(['rounded-md border border-green-700 bg-white shadow-sm mb-2 p-2']) }}>
    <div class="flex items-center space-x-4 mb-4">
        <img src="{{ $reply->user->avatar }}" alt="{{ $reply->user->name }}" class="w-10 h-10 rounded-full">
        <div>
            <div class="flex items-center space-x-2">
                <h3 class="font-semibold text-lg">{{ $reply->user->name }}</h3>
                @if ($reply->comment->conversation->topic->isBlockedBy($reply->user))
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-red-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                </svg>
                @endif

                @if (auth()->user() !== null && auth()->user()->can('block', $reply->comment->conversation->topic) && !$reply->comment->conversation->topic->isBlockedBy($reply->user) && auth()->user()->id != $reply->user->id)
                <form action="{{ route('topics.user.blockUser', ['topic' => $reply->comment->conversation->topic, 'user' => $reply->user]) }}" method="POST">
                    @csrf
                    <button class="p-2 rounded-full hover:bg-slate-100">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                        </svg>
                    </button>
                </form>
                @endif
            </div>
            <p class="text-gray-600 text-sm">{{ $reply->created_at->diffForHumans() }}</p>
        </div>
    </div>

    <p class="text-sm">{{ $reply->content }}</p>

    {{ $slot }}
</x-card>