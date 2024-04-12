<x-card @class([ 'm-2 flex flex-col space-y-2' , 'bg-gray-100'=> !$notification->read_at, ])>
    <p class="text-sm font-normal">
        @switch($notification->type)
        @case(App\Notifications\NewConversationNotification::class)
        <span class="font-semibold">
            {{ $notification->data['user_name'] }}
        </span>
        has created a new conversation titled <span class="font-semibold">{{ $notification->data['conversation_title'] }}</span>
        talking about <span class="font-semibold">{{ $notification->data['topic_name'] }}</span>
        @break
        @case(App\Notifications\CommentNotification::class)
        <span class="font-semibold">
            {{ $notification->data['user_name'] }}
        </span>
        has commented on the conversation titled <span class="font-semibold">{{ $notification->data['conversation_title'] }}</span>
        @break
        @case(App\Notifications\ReplyNotification::class)
        <span class="font-semibold">
            {{ $notification->data['user_name'] }}
        </span>
        has replied to your comment on the conversation titled <span class="font-semibold">{{ $notification->data['conversation_title'] }}</span>
        @break
        @case(App\Notifications\CommentVotedNotification::class)
        <span class="font-semibold">
            {{ $notification->data['user_name'] }}
        </span>
        has voted on your comment on the conversation titled <span class="font-semibold">{{ $notification->data['conversation_title'] }}</span>
        @break
        @default
        <span class="font-semibold">
            {{ $notification->data['user_name'] }}
        </span>
        @break
        @endswitch
    </p>

    <p class="text-gray-400 text-xs">{{ $notification->created_at->diffForHumans() }}</p>

    @if ($notification->type)
    <x-link-button :href="route('conversations.show', ['conversation' => $notification->data['conversation_id']])">
        Go
    </x-link-button>
    @endif
</x-card>