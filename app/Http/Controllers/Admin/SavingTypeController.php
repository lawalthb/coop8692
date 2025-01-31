<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SavingType;
use App\Http\Requests\SavingTypeRequest;
use Illuminate\Support\Str;

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
        $savingType = SavingType::create([
            ...$request->validated(),
            'code' => Str::slug($request->name)
        ]);
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
        public function destroy(SavingType $savingType)
        {
            if ($savingType->name === 'Ordinary Savings') {
                return back()->with('error', 'Ordinary Savings cannot be modified or deleted');
            }

            $savingType->delete();
            return redirect()->route('admin.saving-types.index')
                ->with('success', 'Saving type deleted successfully');
        }
}

