<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.1.8/datatables.min.css" rel="stylesheet">
    <title>GoCar</title>
    @vite('resources/css/app.css')
    @stack('style')
</head>

<body>
    <main class="min-h-screen min-w-full">
        @yield('content')
    </main>
    @stack('scripts')
</body>

</html>
