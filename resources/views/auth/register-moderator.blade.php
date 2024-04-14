<x-layout class="flex items-center justify-center">
    <x-card class="py-8 px-16 w-[500px] m-2">
        <h1 class="mt-6 mb-12 text-center text-4xl font-medium text-slate-600">
            Register your account
        </h1>
        <form action="{{ route('auth.create.moderator') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-8">
                <x-label for="name" :required="true">Your name:</x-label>
                <x-text-input name="name" class="w-full" />
            </div>

            <div class="mb-8">
                <x-label for="phone" :required="true">Enter your phone number:</x-label>
                <x-text-input name="phone" class="w-full" />
            </div>

            <div class="mb-8">
                <x-label for="username" :required="true">Username</x-label>
                <x-text-input name="username" class="w-full" />
            </div>

            <div class="mb-8">
                <x-label for="dob" :required="true">Date of birth</x-label>
                <x-text-input name="dob" type="date" class="w-full" />
            </div>

            <div class="mb-8">
                <x-label for="country" :required="true">Country</x-label>
                <x-text-input name="country" class="w-full" />
            </div>

            <div class="mb-8">
                <x-label for="JMBG" :required="true">JMBG</x-label>
                <x-text-input name="JMBG" class="w-full" />
            </div>

            <div class="mb-8">
                <x-label for="avatar">Profile picture</x-label>
                <input type="file" name="avatar" accept=".jpg,.png">
            </div>

            <div class="mb-8">
                <x-label for="email" :required="true">E-mail</x-label>
                <x-text-input name="email" class="w-full" />
            </div>

            <div class="mb-8">
                <x-label for="gender" :required="true">Gender</x-label>
                <select name="gender" class="w-full cursor-pointer px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-700 focus:border-green-700">
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="O">Other</option>
                </select>
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