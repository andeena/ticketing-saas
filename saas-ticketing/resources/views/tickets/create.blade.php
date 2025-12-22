<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Create Ticket</h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('tickets.store') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-white ">Title</label>
                <input type="text" name="title"
                       class="w-full border rounded-md p-2 bg-gray-800 text-white" required>
            </div>

            <div class="mb-4">
                <label class="block text-white">Description</label>
                <textarea name="description"
                          class="w-full border rounded-md p-2 bg-gray-800 text-white" required></textarea>
            </div>

            <button type="submit"
                style="background:#4f46e5;color:white;padding:8px 20px;
                    border-radius:6px;font-weight:600;">
                Submit Ticket
            </button>


        </form>
    </div>
</x-app-layout>
