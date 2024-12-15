<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SavingType;
use App\Http\Requests\SavingTypeRequest;

class SavingTypeController extends Controller
{
    public function index()
    {
        $savingTypes = SavingType::latest()->get();
        return view('admin.saving-types.index', compact('savingTypes'));
    }

    public function create()
    {
        return view('admin.saving-types.create');
    }

    public function store(SavingTypeRequest $request)
    {
        SavingType::create($request->validated());
        return redirect()->route('admin.saving-types.index')
            ->with('success', 'Saving type created successfully');
    }

    public function edit(SavingType $savingType)
    {
        return view('admin.saving-types.edit', compact('savingType'));
    }

    public function update(SavingTypeRequest $request, SavingType $savingType)
    {
        $savingType->update($request->validated());
        return redirect()->route('admin.saving-types.index')
            ->with('success', 'Saving type updated successfully');
    }
}
