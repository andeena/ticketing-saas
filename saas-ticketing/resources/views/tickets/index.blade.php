<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            {{ __('Tickets') }}
        </h2>
    </x-slot>

    <div class="p-6">

        {{-- Create Ticket Button (ADMIN ONLY) --}}
        @if(auth()->user()->role === \App\Enums\UserRole::ADMIN)
            <a href="{{ route('tickets.create') }}"
               class="inline-block bg-indigo-600 hover:bg-indigo-700
                      text-white px-4 py-2 rounded-md font-semibold mb-4">
                + Create Ticket
            </a>
        @endif

        <div class="mt-6 space-y-4">
            @forelse ($tickets as $ticket)
                <div class="border border-white/10 rounded-lg p-4 bg-gray-800">
                    <h3 class="font-bold text-lg text-white">
                        {{ $ticket->title }}
                    </h3>

                    <p class="mt-1 text-white">
                        {{ $ticket->description }}
                    </p>

                    {{-- Status --}}
                    <div class="mt-3">
                        <span class="text-sm font-semibold text-white">
                            Status:
                            {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                        </span>
                    </div>

                    {{-- Admin Controls --}}
                    @if(auth()->user()->role === \App\Enums\UserRole::ADMIN)
                        <div class="mt-3">
                            <p class="text-sm text-gray-400">
                                Created by: {{ $ticket->user->name ?? 'User' }}
                            </p>

                            <form method="POST"
                                  action="{{ route('tickets.updateStatus', $ticket) }}"
                                  class="mt-2 flex items-center gap-2">
                                @csrf
                                @method('PATCH')

                                <select name="status"
                                        class="border rounded px-2 py-1">
                                    <option value="open"
                                        @selected($ticket->status === 'open')>
                                        Open
                                    </option>
                                    <option value="in_progress"
                                        @selected($ticket->status === 'in_progress')>
                                        In Progress
                                    </option>
                                    <option value="closed"
                                        @selected($ticket->status === 'closed')>
                                        Closed
                                    </option>
                                </select>

                                <button type="submit"
                                    class="bg-green-600 hover:bg-green-700
                                           text-white font-semibold px-4 py-2 rounded-md">
                                    Update
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-gray-500">No tickets yet.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
