<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Account Statement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 150px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f3f4f6;
        }
        .member-info {
            margin-bottom: 20px;
        }
        .summary {
            margin-top: 20px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>COOP8692</h1>
        <h2>Account Statement</h2>
    </div>

    <div class="member-info">
        <p><strong>Member:</strong> {{ auth()->user()->full_name }}</p>
        <p><strong>Member No:</strong> {{ auth()->user()->member_no }}</p>
        <p><strong>Date Generated:</strong> {{ now()->format('d M, Y H:i A') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Reference</th>
                <th>Type</th>
                <th>Description</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->transaction_date->format('d/m/Y') }}</td>
                    <td>{{ $transaction->reference }}</td>
                    <td>{{ ucfirst($transaction->type) }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td>{{ $transaction->debit_amount > 0 ? '₦'.number_format($transaction->debit_amount) : '-' }}</td>
                    <td>{{ $transaction->credit_amount > 0 ? '₦'.number_format($transaction->credit_amount) : '-' }}</td>
                    <td>₦{{ number_format($transaction->balance) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>This statement was automatically generated on {{ now()->format('d M, Y') }}</p>
    </div>
</body>
</html>
