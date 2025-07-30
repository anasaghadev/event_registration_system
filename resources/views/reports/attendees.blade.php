<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>attendance</title>
    <style>
        /* Add this to fix Arabic character rendering */
        * {
            font-family: 'DejaVu Sans', sans-serif;
        }

        body {
            margin: 0;
            padding: 20px;
            font-size: 14px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #2d3748;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th {
            background-color: #4a5568;
            color: white;
            padding: 10px;
            text-align: center;
        }

        td,
        th {
            font-family: 'DejaVu Sans', sans-serif !important;
        }

        td {
            padding: 10px;
            border: 1px solid #e2e8f0;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f7fafc;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e2e8f0;
        }

        .stats {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }

        .stat-card {
            background-color: #ebf8ff;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            width: 45%;
        }

        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #2b6cb0;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>attendance</h1>
        <p>at: {{ now()->format('Y-m-d') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>name</th>
                <th>email</th>
                <th>phone</th>
                <th>attendance</th>
                <th>registered at</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($attendees as $index => $attendee)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $attendee->name }}</td>
                    <td>{{ $attendee->email }}</td>
                    <td>{{ $attendee->phone }}</td>
                    <td>{{ $attendee->is_confirmed ? 'yes' : 'no' }}</td>
                    <td>{{ $attendee->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <div class="stats">
            <div class="stat-card">
                <div>registered attendees</div>
                <div class="stat-value">{{ $attendees->count() }}</div>
            </div>
            <div class="stat-card">
                <div>attended</div>
                <div class="stat-value">{{ $attendees->where('is_confirmed', true)->count() }}</div>
            </div>
        </div>
    </div>
</body>

</html>
