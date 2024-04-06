<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Watch Forum</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @cloudinaryJS
</head>

<body class="from-10% via-30% to-90% mx-auto mt-10 w-full text-slate-700">
    <nav class="mb-8 flex justify-between text-lg font-medium w-3/4 mx-auto">
        <ul class="flex space-x-2">
            <li>
                <a href="{{ route('topics.index') }}" class="flex items-center space-x-6">
                    <img src="/images/WatchBlack.png" alt="Watch Forum" class="w-[50px]" />
                    <p class="font-serif text-black">THE WATCH FORUM</p>
                </a>
            </li>
        </ul>

        <ul class="flex space-x-6 items-center">
            @auth
            @if(auth()->user()->role != null && auth()->user()->role->name == 'ADMIN')
            <x-admin-nav />
            @endif

            @unless (auth()->user()->role == 'ADMIN')
                <li>
                    <a href="{{ route('user.topics') }}">Topics</a>
                </li>
                <li>
                    <a href="{{ route('user.conversations') }}">Conversations</a>
                </li>
            @endunless

            <li>
                <x-avatar :user="auth()->user()" />
            </li>
            <li class="flex items-center">
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>
                        Logout
                    </button>
                </form>
            </li>
            @else
            <li>
                <a href="{{ route('auth.login') }}">Login</a>
            </li>
            <li>
                <a href="{{ route('auth.create') }}" class="border border-green-700 px-4 py-2 rounded-md hover:bg-green-700 hover:text-white">Register</a>
            </li>
            @endauth
        </ul>
    </nav>
    @if (session('success'))
    <div role="alert" class="my-8 rounded-md border-l-4 border-green-300 bg-green-100 p-4 text-green-700 opacity-75 w-3/4 mx-auto">
        <p class="font-bold">Success!</p>
        <p>{{ session('success') }}</p>
    </div>
    @endif
    @if (session('error'))
    <div role="alert" class="my-8 rounded-md border-l-4 border-red-300 bg-red-100 p-4 text-red-700 opacity-75 w-3/4 mx-auto">
        <p class="font-bold">Error!</p>
        <p>{{ session('error') }}</p>
    </div>
    @endif

    <div {{ $attributes->class(['w-3/4 mx-auto min-h-full']) }}>
        {{ $slot }}
    </div>
</body>

</html>