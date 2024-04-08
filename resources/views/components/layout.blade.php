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
            @else
            @can('create', App\Models\Topic::class)
            <li>
                <a href="{{ route('user.topics') }}">My Topics</a>
            </li>
            @endcan
            <li>
                <a href="{{ route('user.conversations') }}">My Conversations</a>
            </li>
            @endif

            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hover:text-blue-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                </svg>
            </a>

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