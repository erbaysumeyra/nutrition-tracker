<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nutrition Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {font-family: system-ui, sans-serif; margin: 24px;}
        .container {max-width: 900px; margin: 0 auto;}
        table {width:100%; border-collapse: collapse;}
        th, td {border:1px solid #ddd; padding:8px;}
        th {background:#f5f5f5; text-align:left;}
        .flash {background:#e7f7ec; border:1px solid #b8e6c7; padding:10px; margin-bottom:12px;}
        .row {display:flex; gap:12px; flex-wrap:wrap;}
        .row > * {flex:1}
        input, textarea {width:100%; padding:8px;}
        .actions a, .actions button {margin-right:8px;}
    </style>
</head>
<body>
<div class="container">
    <h1>Nutrition & Carbon Tracker</h1>

    @if(session('ok'))
        <div class="flash">{{ session('ok') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>
