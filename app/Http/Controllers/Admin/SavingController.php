<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SavingType;
use App\Models\Transaction;
use App\Http\Requests\SavingEntryRequest;
use App\Http\Requests\BulkSavingRequest;
use App\Models\Month;
use Illuminate\Support\Facades\DB;
use App\Services\TransactionService;
use App\Notifications\SavingEntryNotification;
use App\Models\Saving;
use App\Models\Year;
use Carbon\Carbon;

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
        $months = Month::all();
        $years = Year::all();

        return view('admin.savings.create', compact('members', 'savingTypes', 'months', 'years'));
    }


    public function store(SavingEntryRequest $request)
    {
        DB::transaction(function () use ($request) {
            // First save to savings table
            $year_id  = Year::where('year', Carbon::parse($request->transaction_date)->year)->first()->id;

            $saving = Saving::create([
                'user_id' => $request->user_id,
                'saving_type_id' => $request->saving_type_id,
                'month_id' => Carbon::parse($request->transaction_date)->month,
                'year_id' => $year_id,

                'amount' => $request->amount,
                'reference' => generateReference('SAV'),
                'posted_by' => auth()->id(),
                'saving_date' => $request->transaction_date
            ]);

            // Then create transaction record
            $transaction = Transaction::create([
                'user_id' => $request->user_id,
                'transactionable_id' => $saving->id,
                'transactionable_type' => Saving::class,
                'type' => 'savings',
                'credit_amount' => $request->amount,
                'balance' => calculateNewBalance($request->user_id, $request->amount),

                'reference' => $saving->reference,
                'description' => 'Saving deposit for ' . $saving->savingType->name,
                'posted_by' => auth()->id(),
                'transaction_date' => $request->transaction_date
            ]);

            $user = User::find($request->user_id);
            $user->notify(new SavingEntryNotification($transaction, 'Your saving entry has been recorded successfully.'));
        });

        return redirect()->route('admin.savings.index')
            ->with('success', 'Saving entry recorded successfully');
    }
    public function bulkCreate()
    {
        $members = User::where('is_approved', true)->where('is_admin', false)->get();
        $savingTypes = SavingType::where('status', 'active')->get();
        $months = Month::all();
        $years = Year::all();

        return view('admin.savings.bulk-create', compact('members', 'savingTypes', 'months', 'years'));
    }


    public function bulkStore(BulkSavingRequest $request)
    {
        DB::transaction(function () use ($request) {
            foreach ($request->entries as $entry) {
                // Create saving record
                $saving = Saving::create([
                    'user_id' => $entry['user_id'],
                    'saving_type_id' => $entry['saving_type_id'],
                    'amount' => $entry['amount'],
                    'reference' => generateReference('SAV'),
                    'posted_by' => auth()->id(),
                    'month_id' => $request->month_id,
                    'year_id' => $request->year_id
                ]);

                // Create transaction record
                $transaction = Transaction::create([
                    'user_id' => $entry['user_id'],
                    'transactionable_id' => $saving->id,
                    'transactionable_type' => Saving::class,
                    'type' => 'savings',
                    'credit_amount' => $entry['amount'],
                    'balance' => calculateNewBalance($entry['user_id'], $entry['amount']),
                    'reference' => $saving->reference,
                    'description' => 'Bulk saving deposit for ' . $saving->savingType->name,
                    'posted_by' => auth()->id(),
                    'transaction_date' => $request->transaction_date
                ]);

                $user = User::find($entry['user_id']);
                $user->notify(new SavingEntryNotification($transaction, 'Your saving entry has been recorded successfully.'));
            }
        });

        return redirect()->route('admin.savings.index')
            ->with('success', 'Bulk saving entries recorded successfully');
    }

    public function index()
    {
        $transactions = Saving::with(['user', 'savingType'])

            ->latest()
            ->paginate(15);

        return view('admin.savings.index', compact('transactions'));
    }
    public function show(Saving $saving)
    {
        return view('admin.savings.show', compact('saving'));
    }
}
