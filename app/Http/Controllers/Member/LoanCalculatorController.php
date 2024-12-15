<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\LoanType;
use Illuminate\Http\Request;

class LoanCalculatorController extends Controller
{
    public function index()
    {
        $loanTypes = LoanType::where('status', 'active')->get();
        return view('member.loans.calculator', compact('loanTypes'));
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'loan_type_id' => 'required|exists:loan_types,id',
            'amount' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:6|max:18'
        ]);

        $loanType = LoanType::findOrFail($request->loan_type_id);
        $userSavings = auth()->user()->getTotalSavings();

        $interestRate = $request->duration <= 12 ?
            $loanType->interest_rate_12_months :
            $loanType->interest_rate_18_months;

        $data = [
            'eligible' => $this->checkEligibility($loanType, $request->amount, $userSavings),
            'interest_amount' => ($request->amount * $interestRate) / 100,
            'total_amount' => $request->amount + (($request->amount * $interestRate) / 100),
            'monthly_payment' => ($request->amount + (($request->amount * $interestRate) / 100)) / $request->duration
        ];

        return response()->json($data);
    }

    private function checkEligibility($loanType, $requestedAmount, $userSavings)
    {
        if ($requestedAmount < $loanType->minimum_amount || $requestedAmount > $loanType->maximum_amount) {
            return false;
        }

        $requiredSavings = $requestedAmount / $loanType->savings_multiplier;
        return $userSavings >= $requiredSavings;
    }
}
