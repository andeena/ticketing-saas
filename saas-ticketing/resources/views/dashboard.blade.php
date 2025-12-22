<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white dark:text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Ticket Summary -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                    <p class="text-gray-500 text-sm">Total Tickets</p>
                    <p class="text-3xl font-bold">{{ $total }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                    <p class="text-gray-500 text-sm">Open</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $open }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                    <p class="text-gray-500 text-sm">In Progress</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $inProgress }}</p>
                </div>

                <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                    <p class="text-gray-500 text-sm">Closed</p>
                    <p class="text-3xl font-bold text-green-600">{{ $closed }}</p>
                </div>

            </div>

            <!-- Welcome Box -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    Welcome back, <strong>{{ auth()->user()->name }}</strong> 👋
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
