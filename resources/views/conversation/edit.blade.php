<x-layout>
    <x-card class="w-1/2 mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Edit conversation</h1>
        <form action="{{ route('conversations.update', $conversation) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <x-label for="title" :required="true">Title</x-label>
                <x-text-input name="title" class="w-full" :value="old('title', $conversation->title)" />
            </div>

            <div class="mb-4">
                <x-label for="description" :required="true">Description</x-label>
                <x-text-input name="description" class="w-full" type="textarea" :value="old('description', $conversation->description)" />
            </div>

            <x-button class="w-full">Update</x-button>
        </form>

        <form action="{{ route('conversations.destroy', $conversation) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="border border-red-700 px-4 py-2 rounded-md hover:bg-red-700 hover:text-white w-full mt-8">
                Delete this conversation
            </button>
        </form>
    </x-card>
</x-layout>