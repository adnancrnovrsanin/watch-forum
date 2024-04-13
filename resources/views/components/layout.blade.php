<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Watch Forum</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @cloudinaryJS
</head>

<body class="from-10% via-30% to-90% mx-auto mt-10 w-full text-slate-700 bg-slate-50">
    <nav class="mb-8 flex justify-between text-lg font-medium w-3/4 mx-auto">
        <ul class="flex space-x-2">
            <li>
                <a href="{{ route('topics.index') }}" class="flex items-center space-x-6">
                    <img src="/images/WatchBlack.png" alt="Watch Forum" class="w-[50px]" />
                    <p class="font-serif text-slate-700">THE WATCH FORUM</p>
                </a>
            </li>
        </ul>

        <ul class="flex space-x-6 items-center" x-data="{ showNotifications: false }">
            @auth
            @if(auth()->user() !== null && auth()->user()->role != null && auth()->user()->role->name == 'ADMIN')
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

            <div class="relative" @click.away="showNotifications=false">
                <div class="relative">
                    <button class="flex justify-center items-center bg-white h-10 w-10 leading-10 text-center text-gray-800 text-xl shadow-md border border-gray-200 hover:border-gray-300 focus:border-gray-300 rounded-lg transition-all font-semibold outline-none focus:outline-none" @click="
                                $event.preventDefault();showNotifications = true;
                                <?php
                                $user = App\Models\User::find(auth()->id());
                                $user->unreadNotifications->markAsRead();
                                ?>
                            ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hover:text-blue-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                        </svg>
                    </button>

                    @auth
                    @if ($notifications && $notifications->count() > 0 && $notifications->where('read_at', null)->count() > 0)
                    <span class="absolute -top-2.5 -right-2.5 bg-red-500 text-white rounded-full px-2 py-1 text-xs">{{ $notifications->where('read_at', null)->count() }}</span>
                    @endif
                    @endauth
                </div>

                @auth
                <div class="absolute mt-12 top-0 left-1 min-w-full w-64 z-30" style="display:none;" x-show="showNotifications" x-transition:enter="transition ease duration-100 transform" x-transition:enter-start="opacity-0 scale-90 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease duration-100 transform" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-90 translate-y-1">
                    <div class="bg-white overflow-auto rounded-lg shadow-md w-full relative z-10 py-2 border border-gray-300 text-gray-800 text-xs">
                        @if ($notifications->count() > 0)
                        @foreach ($notifications->sortByDesc('created_at') as $notification)
                        <x-notification-card :$notification />
                        @endforeach
                        @endif
                    </div>
                </div>
                @endauth
            </div>

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