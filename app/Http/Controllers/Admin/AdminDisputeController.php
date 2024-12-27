<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TransactionDispute;
use Illuminate\Http\Request;
use App\Notifications\DisputeResponseNotification;

class AdminDisputeController extends Controller
{
    public function index()
    {
        $disputes = TransactionDispute::with(['user', 'transaction'])
            ->latest()
            ->paginate(15);

        return view('admin.disputes.index', compact('disputes'));
    }

    public function respond(Request $request, TransactionDispute $dispute)
    {
        $validated = $request->validate([
            'admin_response' => 'required|string|max:500'
        ]);

        $dispute->update([
            'status' => 'resolved',
            'admin_response' => $validated['admin_response']
        ]);

        // Notify member about the response
        $dispute->user->notify(new DisputeResponseNotification($dispute));

        return redirect()->route('disputes.index')
            ->with('success', 'Response sent successfully');
    }
}
