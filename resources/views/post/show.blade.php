<x-layout>
    <x-card>
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">{{ $post->title }}</h1>
        </div>
        <p class="text-gray-600">{{ $post->content }}</p>
    </x-card>
</x-layout>