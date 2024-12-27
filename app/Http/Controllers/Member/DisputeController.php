class DisputeController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'description' => 'required|string'
        ]);

        $dispute = TransactionDispute::create([
            'user_id' => auth()->id(),
            'transaction_id' => $validated['transaction_id'],
            'description' => $validated['description']
        ]);

        return redirect()->back()->with('success', 'Dispute submitted successfully');
    }
}
