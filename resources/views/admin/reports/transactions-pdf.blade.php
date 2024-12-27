<!DOCTYPE html>
<html>
<head>
    <title>Transactions Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f3f4f6;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .summary {
            margin: 20px 0;
        }
        .credit {
            color: #059669;
        }
        .debit {
            color: #DC2626;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Transactions Report</h2>
        <p>Generated on: {{ now()->format('M d, Y H:i:s') }}</p>
    </div>

    <div class="summary">
        <p>Total Credits: ₦{{ number_format($transactions->sum('credit_amount'), 2) }}</p>
        <p>Total Debits: ₦{{ number_format($transactions->sum('debit_amount'), 2) }}</p>
        <p>Net Balance: ₦{{ number_format($transactions->sum('credit_amount') - $transactions->sum('debit_amount'), 2) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Reference</th>
                <th>Member</th>
                <th>Type</th>
                <th>Credit</th>
                <th>Debit</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->created_at->format('M d, Y') }}</td>
                <td>{{ $transaction->reference }}</td>
                <td>{{ $transaction->user->full_name }}</td>
                <td>{{ ucfirst($transaction->type) }}</td>
                <td class="credit">{{ $transaction->credit_amount ? '₦'.number_format($transaction->credit_amount, 2) : '-' }}</td>
                <td class="debit">{{ $transaction->debit_amount ? '₦'.number_format($transaction->debit_amount, 2) : '-' }}</td>
                <td>{{ $transaction->description }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
