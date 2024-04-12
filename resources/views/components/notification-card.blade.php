<x-card @class([ 'm-2 flex flex-col space-y-2' , 'bg-gray-100'=> !$notification->read_at, ])>
    <p class="text-sm font-normal">
        <span class="font-semibold">
            {{ $notification->data['user_name'] }}
        </span>
        has created a new conversation titled <span class="font-semibold">{{ $notification->data['conversation_title'] }}</span>
        talking about <span class="font-semibold">{{ $notification->data['topic_name'] }}</span>
    </p>

    <p class="text-gray-400 text-xs">{{ $notification->created_at->diffForHumans() }}</p>
</x-card>