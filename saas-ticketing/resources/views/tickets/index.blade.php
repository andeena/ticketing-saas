<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            {{ auth()->user()->role === 'admin' ? 'All Tickets' : 'My Tickets' }}
        </h2>
    </x-slot>

    <div class="p-6">
        {{-- Create Ticket Button --}}
        <a href="{{ route('tickets.create') }}"
           style="display: inline-block; background-color: #4f46e5; color: #ffffff; padding: 10px 18px; border-radius: 6px; font-weight: 600; margin-bottom: 16px;
              ">
            + Create Ticket
        </a>

        <div class="mt-6 space-y-4">
            @forelse ($tickets as $ticket)
                <div class="border rounded p-4 bg-white shadow-sm">
                    <h3 class="font-bold text-lg">
                        {{ $ticket->title }}
                    </h3>

                    <p class="mt-1 text-gray-700">
                        {{ $ticket->description }}
                    </p>

                    {{-- Status --}}
                    <div class="mt-3">
                        <span class="text-sm font-semibold text-gray-600">
                            Status: {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                        </span>
                    </div>

                    {{-- Admin Controls --}}
                    @if(auth()->user()->role === 'admin')
                        <div class="mt-3">
                            <p class="text-sm text-gray-500">
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
                                        {{ $ticket->status === 'open' ? 'selected' : '' }}>
                                        Open
                                    </option>
                                    <option value="in_progress"
                                        {{ $ticket->status === 'in_progress' ? 'selected' : '' }}>
                                        In Progress
                                    </option>
                                    <option value="closed"
                                        {{ $ticket->status === 'closed' ? 'selected' : '' }}>
                                        Closed
                                    </option>
                                </select>

                                <button type="submit"
                                    class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-md shadow">
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
