<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SavingType;
use App\Models\Transaction;
use App\Http\Requests\SavingEntryRequest;
use App\Http\Requests\BulkSavingRequest;
use Illuminate\Support\Facades\DB;
use App\Services\TransactionService;
use App\Notifications\SavingEntryNotification;

class SavingController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function create()
    {
        $members = User::where('is_approved', true)->where('is_admin', false)->get();
        $savingTypes = SavingType::where('status', 'active')->get();
        return view('admin.savings.create', compact('members', 'savingTypes'));
    }

    public function store(SavingEntryRequest $request)
    {
        DB::transaction(function () use ($request) {
            $transaction = $this->transactionService->createSavingTransaction(
                $request->user_id,
                $request->saving_type_id,
                $request->amount,
                $request->transaction_date
            );

            $user = User::find($request->user_id);
            $user->notify(new SavingEntryNotification($transaction));
        });

        return redirect()->route('admin.savings.index')
            ->with('success', 'Saving entry recorded successfully');
    }

    public function bulkCreate()
    {
        $members = User::where('is_approved', true)->where('is_admin', false)->get();
        $savingTypes = SavingType::where('status', 'active')->get();
        return view('admin.savings.bulk-create', compact('members', 'savingTypes'));
    }

    public function bulkStore(BulkSavingRequest $request)
    {
        DB::transaction(function () use ($request) {
            foreach ($request->entries as $entry) {
                $transaction = $this->transactionService->createSavingTransaction(
                    $entry['user_id'],
                    $entry['saving_type_id'],
                    $entry['amount'],
                    $request->transaction_date
                );

                $user = User::find($entry['user_id']);
                $user->notify(new SavingEntryNotification($transaction));
            }
        });

        return redirect()->route('admin.savings.index')
            ->with('success', 'Bulk saving entries recorded successfully');
    }

    public function index()
    {
        $transactions = Transaction::with(['user', 'savingType'])
            ->where('type', 'savings')
            ->latest()
            ->paginate(15);

        return view('admin.savings.index', compact('transactions'));
    }
}
