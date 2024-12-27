<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\TransactionDispute;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Notifications\DisputeSubmittedNotification;


class MemberDisputeController extends Controller
{
    public function index()
    {
        $disputes = TransactionDispute::where('user_id', auth()->id())
            ->with(['transaction'])
            ->latest()
            ->paginate(15);

        return view('member.disputes.index', compact('disputes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'description' => 'required|string|max:500'
        ]);

        $dispute = TransactionDispute::create([
            'user_id' => auth()->id(),
            'transaction_id' => $validated['transaction_id'],
            'description' => $validated['description'],
            'status' => 'pending'
        ]);

        // Notify admin about new dispute
        $admins = User::where('is_admin', true)->get();
        $dispute->user->notify(new DisputeSubmittedNotification($dispute, 'pending'));


        return redirect()->back()
            ->with('success', 'Your dispute has been submitted successfully');
    }
}
