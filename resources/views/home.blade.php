<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
    </head>
    <body>
        <div id="app">
            <movie-list></movie-list>
        </div>
    </body>
    <script src="{{ mix('js/app.js') }}"></script>
</html>
