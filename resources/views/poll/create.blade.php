<x-layout class="flex items-center justify-center">
    <x-card class="py-8 px-16 w-[500px] m-2">
        <h1 class="mt-6 mb-12 text-center text-4xl font-medium text-slate-600">
            Create a poll for your topic
        </h1>
        <form action="{{ route('topic.polls.store', $topic) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-8">
                <x-label for="question" :required="true">What do you want to ask?</x-label>
                <x-text-input name="question" class="w-full" />
            </div>

            <x-button class="w-full font-medium">Create a poll</x-button>
        </form>
    </x-card>
</x-layout>