<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Month;
use App\Models\Year;
use App\Models\SavingType;
use Illuminate\Http\Request;

class SavingsReportController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'months' => Month::all(),
            'years' => Year::orderBy('year', 'desc')->get(),
            'saving_types' => SavingType::where('status', 'active')->get(),
            'savings' => auth()->user()->getSavingsReport(
                $request->month_id,
                $request->year_id,
                $request->saving_type_id
            )
        ];

        return view('member.reports.savings', compact('data'));
    }
}
