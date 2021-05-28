<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="{{ mix('css/app.css') }}">
        <title>Home</title>
    </head>
    <body>
        <div id="app">
            <movie-list></movie-list>
        </div>
    </body>
    <script src="{{ mix('js/app.js') }}"></script>
</html>
