<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class DashboardController extends Controller
{
    public function index()
    {
        $tenantId = auth()->user()->tenant_id;

        $total = Ticket::where('tenant_id', $tenantId)->count();
        $open = Ticket::where('tenant_id', $tenantId)
                        ->where('status', 'open')->count();
        $inProgress = Ticket::where('tenant_id', $tenantId)
                        ->where('status', 'in_progress')->count();
        $closed = Ticket::where('tenant_id', $tenantId)
                        ->where('status', 'closed')->count();

        return view('dashboard', compact(
            'total', 'open', 'inProgress', 'closed'
        ));
    }
}
