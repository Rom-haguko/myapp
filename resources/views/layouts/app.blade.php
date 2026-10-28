<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'MyApp')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .container { max-width: 900px; margin: 0 auto; padding: 20px; }
        .error { color: red; }
        .success { color: green; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f0f0f0; }
    </style>
</head>
<body>

    @include('partials.header')

    <div class="container">
        @yield('content')
    </div>

    @include('partials.footer')

</body>
</html>
