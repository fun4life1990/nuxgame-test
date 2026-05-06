<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Page A</title>
</head>
<body>
    <h1>Hello, {{ $link->player->username }}!</h1>

    <p>
        Your link: <a href="{{ route('play.show', $link) }}">{{ url(route('play.show', $link, false)) }}</a><br>
        Expires at: {{ $link->expires_at->toDateTimeString() }}
    </p>

    @if (session('lucky'))
        @php($lucky = session('lucky'))
        <h2>Result</h2>
        <p>
            Number: <strong>{{ $lucky->number }}</strong><br>
            Status: <strong>{{ $lucky->is_win ? 'Win' : 'Lose' }}</strong><br>
            Amount: <strong>{{ $lucky->amount }}</strong>
        </p>
    @endif

    <form method="POST" action="{{ route('play.lucky', $link) }}">
        @csrf
        <button type="submit">ImFeelingLucky</button>
    </form>

    <p><a href="{{ route('play.history', $link) }}">History</a></p>

    <hr>

    <form method="POST" action="{{ route('play.regenerate', $link) }}">
        @csrf
        <button type="submit">Regenerate</button>
    </form>

    <form method="POST" action="{{ route('play.deactivate', $link) }}">
        @csrf
        <button type="submit">Deactivate</button>
    </form>
</body>
</html>
