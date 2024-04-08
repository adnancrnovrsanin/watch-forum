<x-layout>
    <x-card class="w-1/2 mx-auto">
        <h1 class="text-2xl font-semibold mb-4">Edit topic</h1>
        <form action="{{ route('topics.update', $topic) }}" method="POST">
            @csrf
            @method('PATCH')
            <div class="mb-4">
                <x-label for="name" :required="true">Name</x-label>
                <x-text-input name="name" class="w-full" :value="old('name', $topic->name)" />
            </div>

            <div class="mb-4">
                <x-label for="description" :required="true">Description</x-label>
                <x-text-input name="description" class="w-full" type="textarea" :value="old('description', $topic->description)" />
            </div>

            <x-button class="w-full">Update</x-button>
        </form>

        <form action="{{ route('topics.destroy', $topic) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="border border-red-700 px-4 py-2 rounded-md hover:bg-red-700 hover:text-white w-full mt-8">
                Delete this topic
            </button>
        </form>
    </x-card>
</x-layout>