<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\LoanGuarantor;
use Illuminate\Http\Request;

class GuarantorController extends Controller
{
    public function index()
    {
        $data = [
            'pending_requests' => LoanGuarantor::where('user_id', auth()->id())
                ->where('status', 'pending')
                ->with(['loan', 'loan.user'])
                ->latest()
                ->get(),

            'past_guarantees' => LoanGuarantor::where('user_id', auth()->id())
                ->whereIn('status', ['approved', 'rejected'])
                ->with(['loan', 'loan.user'])
                ->latest()
                ->get()
        ];

        return view('member.guarantors.index', compact('data'));
    }

    public function respond(Request $request, LoanGuarantor $guarantor)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'comment' => 'required|string|max:500'
        ]);

        $guarantor->update([
            'status' => $request->status,
            'comment' => $request->comment,
            'responded_at' => now()
        ]);

        return redirect()->route('member.guarantors.index')
            ->with('success', 'Response submitted successfully');
    }
}
