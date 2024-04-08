<x-layout>
    <p class="my-8 text-xl font-semibold">Registration requests pending</p>

    <table class="min-w-full">
        <thead>
            <tr>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Wanted role</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Approve</th>
                <th class="px-6 py-3 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">Reject</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users->sortByDesc('created_at') as $user)
            <tr>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $user->name }}</td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $user->email }}</td>
                @if ($user->role != null)
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{ $user->role->name }}</td>
                @else
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">User</td>
                @endif
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.approve') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button type="submit" class="text-indigo-600 hover:text-indigo-900">Approve</button>
                    </form>
                </td>
                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.reject') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button type="submit" class="text-red-600 hover:text-red-900">Reject</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>