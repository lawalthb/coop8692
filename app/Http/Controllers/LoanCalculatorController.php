<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\LoanType;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MemberLoanController extends Controller
{
public function calculate(Request $request)
{
    $loanType = LoanType::findOrFail($request->loan_type_id);
    $user = auth()->user();

    // Calculate loan details
    $interestRate = $request->duration == 12 ?
        $loanType->interest_rate_12_months :
        $loanType->interest_rate_18_months;

    $interestAmount = ($request->amount * $interestRate / 100);
    $totalAmount = $request->amount + $interestAmount;
    $monthlyPayment = $totalAmount / $request->duration;

    // Check eligibility
    $eligibilityCheck = $this->checkEligibility($user, $loanType, $request->amount);

    return response()->json([
        'eligible' => $eligibilityCheck['eligible'],
        'message' => $eligibilityCheck['message'],
        'monthlyPayment' => number_format($monthlyPayment, 2),
        'totalInterest' => number_format($interestAmount, 2),
        'totalRepayment' => number_format($totalAmount, 2)
    ]);
}
private function checkEligibility($user, $loanType, $amount)
{
    // Check minimum savings duration
    $savingsDuration = $user->getSavingsDurationInMonths();
    if ($savingsDuration < $loanType->required_active_savings_months) {
        return [
            'eligible' => false,
            'message' => "You need at least {$loanType->required_active_savings_months} months of active savings."
        ];
    }

    // Check savings multiplier
    $totalSavings = $user->getTotalSavings();
    $maxLoanAmount = $totalSavings * $loanType->savings_multiplier;
    if ($amount > $maxLoanAmount) {
        return [
            'eligible' => false,
            'message' => "Maximum loan amount based on your savings is ₦" . number_format($maxLoanAmount)
        ];
    }

    // Check loan amount limits
    if ($amount < $loanType->minimum_amount || $amount > $loanType->maximum_amount) {
        return [
            'eligible' => false,
            'message' => "Loan amount must be between ₦" . number_format($loanType->minimum_amount) . " and ₦" . number_format($loanType->maximum_amount)
        ];
    }

    return ['eligible' => true];
}
}
