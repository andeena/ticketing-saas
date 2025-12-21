<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-100">
            Invite User
        </h2>
    </x-slot>

    <div class="p-6 max-w-xl">
        <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
            @csrf

            {{-- Name --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Name
                </label>
                <input
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700
                           bg-white dark:bg-gray-800 text-gray-900 dark:text-white p-2"
                    required
                >
                @error('name')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Email
                </label>
                <input
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700
                           bg-white dark:bg-gray-800 text-gray-900 dark:text-white p-2"
                    required
                >
                @error('email')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Password
                </label>
                <input
                    name="password"
                    type="password"
                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700
                           bg-white dark:bg-gray-800 text-gray-900 dark:text-white p-2"
                    required
                >
                @error('password')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Role (admin-only) --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                    Role
                </label>

                <select
                    name="role"
                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700
                        bg-white dark:bg-gray-800 text-gray-900 dark:text-white p-2"
                    required
                >
                    <option value="">-- Select Role --</option>

                    <option value="{{ \App\Enums\UserRole::USER->value }}"
                        {{ old('role') === \App\Enums\UserRole::USER->value ? 'selected' : '' }}>
                        User
                    </option>

                    <option value="{{ \App\Enums\UserRole::ADMIN->value }}"
                        {{ old('role') === \App\Enums\UserRole::ADMIN->value ? 'selected' : '' }}>
                        Admin
                    </option>
                </select>

                @error('role')
                    <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- Submit --}}
            <div class="pt-4">
                <button
                    type="submit"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600
                           text-white rounded-md font-semibold hover:bg-indigo-700"
                >
                    Invite User
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
