<x-layout class="flex items-center justify-center">
    <x-card class="py-8 px-16 w-[500px]">
        <h1 class="mt-6 mb-12 text-center text-4xl font-medium text-slate-600">
            Register your account
        </h1>
        <form action="{{ route('auth.create') }}" method="POST">
            @csrf
            <div class="mb-8">
                <x-label for="name" :required="true">Your name:</x-label>
                <x-text-input name="name" class="w-full" />
            </div>

            <div class="mb-8">
                <x-label for="email" :required="true">E-mail</x-label>
                <x-text-input name="email" class="w-full" />
            </div>

            <div class="mb-10">
                <x-label for="password" :required="true">
                    Password
                </x-label>
                <x-text-input name="password" type="password" class="w-full" />
            </div>

            <div class="mb-10">
                <x-label for="password_confirmation" :required="true">
                    Confirm password
                </x-label>
                <x-text-input name="password_confirmation" type="password" class="w-full" />
            </div>

            <x-button class="w-full font-medium">Create account</x-button>
        </form>
    </x-card>
</x-layout>