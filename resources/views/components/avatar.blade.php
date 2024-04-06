<div class="flex items-center space-x-3">
    <p class="font-medium">
        {{ $user->name }}
    </p>

    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-12 h-12 rounded-full">
</div>