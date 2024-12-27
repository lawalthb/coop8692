<!DOCTYPE html>
<html>

<head>
    <title>Members Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f3f4f6;
        }
    </style>
</head>

<body>
    <h2>Members Report</h2>
    <table>
        <thead>
            <tr>
                <th>Member No</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Join Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td>{{ $member->member_no }}</td>
                <td>{{ $member->full_name }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->phone_number }}</td>
                <td>{{ $member->is_approved ? 'Active' : 'Inactive' }}</td>
                <td>{{ $member->created_at->format('M d, Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
