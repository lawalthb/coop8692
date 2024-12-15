<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Withdrawal;
use App\Models\SavingType;
use App\Http\Requests\WithdrawalRequest;
use Illuminate\Support\Str;

class WithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = auth()->user()->withdrawals()->latest()->paginate(10);
        $savingTypes = SavingType::where('allow_withdrawal', true)->get();

        return view('member.withdrawals.index', compact('withdrawals', 'savingTypes'));
    }

    public function store(WithdrawalRequest $request)
    {
        $withdrawal = Withdrawal::create([
            'user_id' => auth()->id(),
            'saving_type_id' => $request->saving_type_id,
            'reference' => 'WTH' . Str::random(8),
            'amount' => $request->amount,
            'bank_name' => $request->bank_name,
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'reason' => $request->reason
        ]);

        return redirect()->route('member.withdrawals.index')
            ->with('success', 'Withdrawal request submitted successfully');
    }
}
