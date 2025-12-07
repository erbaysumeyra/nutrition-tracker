<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nutrition Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            margin: 2rem;
            background: #f5f5f5;
        }
        nav {
            margin-bottom: 1.5rem;
        }
        nav a {
            margin-right: 1rem;
            text-decoration: none;
            color: #2563eb;
            font-weight: 500;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .container {
            background: #ffffff;
            padding: 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        }
        .flash-success {
            background: #dcfce7;
            color: #166534;
            padding: 0.75rem 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
            border: 1px solid #bbf7d0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        th, td {
            border: 1px solid #e5e7eb;
            padding: 0.5rem 0.75rem;
            text-align: left;
        }
        th {
            background: #f3f4f6;
        }
        .actions a,
        .actions form button {
            margin-right: 0.5rem;
            font-size: 0.875rem;
        }
        .actions form {
            display: inline-block;
        }
        label {
            display: block;
            margin-top: 0.75rem;
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
            font-weight: 500;
        }
        input[type="text"],
        input[type="number"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            border: 1px solid #d1d5db;
            font-size: 0.9rem;
        }
        button,
        .btn {
            display: inline-block;
            border-radius: 0.375rem;
            padding: 0.4rem 0.9rem;
            font-size: 0.9rem;
            border: none;
            cursor: pointer;
        }
        .btn-primary,
        button[type="submit"] {
            background: #2563eb;
            color: #ffffff;
        }
        .btn-secondary {
            background: #e5e7eb;
            color: #111827;
        }
        .btn-danger {
            background: #dc2626;
            color: #ffffff;
        }
        .error {
            color: #b91c1c;
            font-size: 0.8rem;
        }
    </style>
</head>
<body>
    <nav>
        <a href="{{ url('/') }}">Home</a>
        <a href="{{ route('recipes.index') }}">Recipes</a>
        <a href="{{ route('recipes.create') }}">Add recipe</a>
        <a href="{{ route('goals.index') }}">Goals</a>
        <a href="{{ route('calendar.index') }}">Calendar</a>
        <a href="{{ route('biometrics.index') }}">Biometrics</a>
    </nav>

    <div class="container">
        @if (session('success'))
            <div class="flash-success">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
