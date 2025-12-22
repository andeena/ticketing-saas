<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Everyone sees all tickets in the same tenant
        $tickets = Ticket::where('tenant_id', $user->tenant_id)
            ->latest()
            ->get();

        return view('tickets.index', compact('tickets'));
    }


    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Ticket::create([
            'tenant_id' => Auth::user()->tenant_id,
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'open',
        ]);

        return redirect()->route('tickets.index')
            ->with('success', 'Ticket berhasil dibuat');
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        // Pastikan hanya admin & tenant yang sama
        if (
            auth()->user()->role !== 'admin' ||
            $ticket->tenant_id !== auth()->user()->tenant_id
        ) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:open,in_progress,closed',
        ]);

        $ticket->update([
            'status' => $request->status,
        ]);

        return back()->with('success', 'Status ticket berhasil diupdate');
    }

}
