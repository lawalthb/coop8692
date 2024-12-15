<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoanType;
use App\Http\Requests\LoanTypeRequest;

class LoanTypeController extends Controller
{
    public function index()
    {
        $loanTypes = LoanType::latest()->get();
        return view('admin.loan-types.index', compact('loanTypes'));
    }

    public function create()
    {
        return view('admin.loan-types.create');
    }

    public function store(LoanTypeRequest $request)
    {
        LoanType::create($request->validated());
        return redirect()->route('admin.loan-types.index')
            ->with('success', 'Loan type created successfully');
    }

    public function edit(LoanType $loanType)
    {
        return view('admin.loan-types.edit', compact('loanType'));
    }

    public function update(LoanTypeRequest $request, LoanType $loanType)
    {
        $loanType->update($request->validated());
        return redirect()->route('admin.loan-types.index')
            ->with('success', 'Loan type updated successfully');
    }
}
