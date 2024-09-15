<!doctype html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Notes</title>
    @vite('resources/js/pace.min.js')
    @vite('resources/css/pace-theme-loading-bar.css')
</head>
<body>
@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@yield('content')

</body>
</html>
