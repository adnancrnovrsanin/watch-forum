<div class="w-full relative">
    @if ($pollAnswer->poll->didUserVote() || auth()->guest())
    @if ($pollAnswer->didUserVoteThisAnswer())
    <div class="p-4 border border-green-700 rounded-md mb-4">
        <div class="flex justify-between mb-1">
            <span class="text-base font-medium text-slate-700">{{ $pollAnswer->answer }}</span>
            <span class="text-sm font-medium text-slate-700">{{ round($pollAnswer->calculatePercentage(), 2) }}%</span>
        </div>
        <div class="w-full bg-white border border-green-700 rounded-full h-2.5">
            <div class="bg-green-700 h-2.5 rounded-full" style="width: {{ round($pollAnswer->calculatePercentage(), 2) . "%" }}"></div>
        </div>
    </div>
    @else
    <div class="flex justify-between mb-1">
        <span class="text-base font-medium text-slate-700">{{ $pollAnswer->answer }}</span>
        <span class="text-sm font-medium text-slate-700">{{ round($pollAnswer->calculatePercentage(), 2) }}%</span>
    </div>
    <div class="w-full bg-white border border-gray-500 rounded-full h-2.5 mb-4">
        <div class="bg-gray-500 h-2.5 rounded-full" style="width: {{ round($pollAnswer->calculatePercentage(), 2) . "%" }}"></div>
    </div>
    @endif
    @else
    <form action="{{ route('polls.vote', $pollAnswer) }}" method="POST">
        @csrf
        <x-button type="submit" class="mb-4 w-full text-left font-medium">
            {{ $pollAnswer->answer }}
        </x-button>
    </form>
    @endif
</div>