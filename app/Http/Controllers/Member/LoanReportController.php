<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Month;
use App\Models\Year;
use App\Models\LoanType;
use Illuminate\Http\Request;

class LoanReportController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'months' => Month::all(),
            'years' => Year::orderBy('year', 'desc')->get(),
            'loan_types' => LoanType::where('status', 'active')->get(),
            'loans' => auth()->user()->getLoanReport(
                $request->month_id,
                $request->year_id,
                $request->loan_type_id,
                $request->status
            )
        ];

        return view('member.reports.loans', compact('data'));
    }
}
