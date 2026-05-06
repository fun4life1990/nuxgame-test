<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <p>
            <label>Username<br>
                <input type="text" name="username" value="{{ old('username') }}" required>
            </label>
        </p>
        <p>
            <label>Phonenumber (E.164, e.g. +380501234567)<br>
                <input type="text" name="phone_number" value="{{ old('phone_number') }}" required>
            </label>
        </p>
        <p><button type="submit">Register</button></p>
    </form>
</body>
</html>
