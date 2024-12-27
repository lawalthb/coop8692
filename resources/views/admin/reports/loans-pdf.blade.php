<!DOCTYPE html>
<html>
<head>
    <title>Loans Report</title>
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
    </style>
</head>
<body>
    <div class="header">
        <h2>Loans Report</h2>
        <p>Generated on: {{ now()->format('M d, Y H:i:s') }}</p>
    </div>

    <div class="summary">
        <p>Total Loans: {{ $loans->count() }}</p>
        <p>Total Amount: ₦{{ number_format($loans->sum('amount'), 2) }}</p>
        <p>Total Interest: ₦{{ number_format($loans->sum('interest_amount'), 2) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Reference</th>
                <th>Member</th>
                <th>Amount</th>
                <th>Interest</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($loans as $loan)
            <tr>
                <td>{{ $loan->reference }}</td>
                <td>{{ $loan->user->full_name }}</td>
                <td>₦{{ number_format($loan->amount, 2) }}</td>
                <td>₦{{ number_format($loan->interest_amount, 2) }}</td>
                <td>{{ $loan->duration }} months</td>
                <td>{{ ucfirst($loan->status) }}</td>
                <td>{{ $loan->created_at->format('M d, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
