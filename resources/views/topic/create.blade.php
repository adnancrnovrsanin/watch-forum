<x-layout class="flex items-center justify-center">
    <x-card class="py-8 px-16 w-[500px]">
        <h1 class="mt-6 mb-12 text-center text-4xl font-medium text-slate-600">
            Create a new topic to discuss
        </h1>
        <form action="{{ route('topics.store') }}" method="POST">
            @csrf
            <div class="mb-8">
                <x-label for="name" :required="true">Name</x-label>
                <x-text-input name="name" class="w-full" />
            </div>

            <div class="mb-8">
                <x-label for="description" :required="true">Description</x-label>
                <x-text-input name="description" class="w-full" type="textarea" />
            </div>

            <x-button class="w-full font-medium">Submit</x-button>
        </form>
    </x-card>
</x-layout>