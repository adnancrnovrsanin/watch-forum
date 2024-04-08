<x-card class="mb-4">
    <div class="flex items-center space-x-4 mb-4">
        <img src="{{ $poll->topic->user->avatar }}" alt="{{ $poll->topic->user->name }}" class="w-12 h-12 rounded-full">
        <div>
            <h3 class="font-semibold">{{ $poll->topic->user->name }}</h3>
            <p class="text-gray-600 text-sm">{{ $poll->created_at->diffForHumans() }}</p>
        </div>
    </div>

    <h2 class="mb-4 text-xl font-semibold">{{ $poll->question }}</h2>

    @foreach ($poll->answers as $pollAnswer)
    <x-answer-bar :$pollAnswer />
    @endforeach

    {{ $slot }}
</x-card>