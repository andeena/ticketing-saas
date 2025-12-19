<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Invite User</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="mb-4">
                <label>Name</label>
                <input name="name" class="border rounded w-full p-2" required>
            </div>

            <div class="mb-4">
                <label>Email</label>
                <input name="email" type="email"
                       class="border rounded w-full p-2" required>
            </div>

            <div class="mb-4">
                <label>Password</label>
                <input name="password" type="password"
                       class="border rounded w-full p-2" required>
            </div>

            <button
                style="background:#4f46e5;color:white;padding:8px 16px;border-radius:6px;">
                Invite User
            </button>
        </form>
    </div>
</x-app-layout>
