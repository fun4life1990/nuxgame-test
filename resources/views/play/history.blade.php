<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>History</title>
    <style>
        table { border-collapse: collapse; }
        th, td { border: 1px solid #888; padding: 6px; }
    </style>
</head>
<body>
    <h1>Last {{ $results->count() }} results</h1>

    @if ($results->isEmpty())
        <p>No plays yet.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>When</th>
                    <th>Number</th>
                    <th>Status</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($results as $result)
                    <tr>
                        <td>{{ $result->created_at->toDateTimeString() }}</td>
                        <td>{{ $result->number }}</td>
                        <td>{{ $result->is_win ? 'Win' : 'Lose' }}</td>
                        <td>{{ $result->amount }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <p><a href="{{ route('play.show', $link) }}">Back</a></p>
</body>
</html>
