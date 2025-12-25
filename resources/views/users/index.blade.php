<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white">User Management</h2>
    </x-slot>

    <div class="p-6">
        <table class="w-full border rounded">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="p-2 border">Name</th>
                    <th class="p-2 border">Email</th>
                    <th class="p-2 border">Role</th>
                    <th class="p-2 border">Action</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr class="text-center">
                    <td class="p-2 border text-white">
                        {{ $user->name }}
                    </td>

                    <td class="p-2 border text-white">
                        {{ $user->email }}
                    </td>

                    <td class="p-2 border">
                        <span class="inline-flex items-center justify-center
                                    px-2 py-1 rounded text-sm
                            {{ $user->role === \App\Enums\UserRole::ADMIN
                                ? 'bg-indigo-100 text-indigo-700'
                                : 'bg-gray-100 text-gray-700' }}">
                            {{ ucfirst($user->role->value) }}
                        </span>
                    </td>

                    {{-- Action --}}
                    <td class="p-2 border">
                        @if ($user->id !== auth()->id())
                            <form method="POST"
                                action="{{ route('users.updateRole', $user) }}"
                                x-data="{ changed: false }"
                                class="flex items-center justify-center gap-2">
                                @csrf
                                @method('PATCH')

                                <select name="role"
                                        class="bg-gray-800 text-white rounded px-2 py-1"
                                        @change="changed = true">
                                    @foreach (\App\Enums\UserRole::cases() as $role)
                                        <option value="{{ $role->value }}"
                                            @selected($user->role === $role)>
                                            {{ ucfirst($role->value) }}
                                        </option>
                                    @endforeach
                                </select>

                                <button type="submit"
                                        x-show="changed"
                                        x-transition
                                        onclick="return confirm('Are you sure you want to change this user’s role?')"
                                        class="bg-indigo-600 hover:bg-indigo-700
                                            text-white px-3 py-1 rounded text-sm">
                                    Confirm
                                </button>
                            </form>
                        @else
                            <span class="text-gray-500 text-sm">You</span>
                        @endif
                    </td>

                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
</x-app-layout>
