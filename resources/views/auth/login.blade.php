<x-layout class="flex items-center justify-center">
    <x-card class="py-8 px-16 w-[500px]">
        <h1 class="mt-6 mb-12 text-center text-4xl font-medium text-slate-600">
            Login to your account
        </h1>
        <form action="{{ route('auth.login') }}" method="POST">
            @csrf

            <div class="mb-8">
                <x-label for="email" :required="true">E-mail</x-label>
                <x-text-input name="email" class="w-full" />
            </div>

            <div class="mb-8">
                <x-label for="password" :required="true">
                    Password
                </x-label>
                <x-text-input name="password" type="password" class="w-full" />
            </div>

            <div class="mb-8 flex justify-between text-sm font-medium">
                <div>
                    <div class="flex items-center space-x-2">
                        <input type="checkbox" name="remember" class="rounded-sm border border-slate-400">
                        <label for="remember">Remember me</label>
                    </div>
                </div>
                <div>
                    <a href="#" class="text-indigo-600 hover:underline">

                    </a>
                </div>
            </div>

            <x-button class="w-full font-medium">Login</x-button>
        </form>
    </x-card>
</x-layout>