<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/js/app.js')
    </head>

    <body>
        <div id="app">
            <home-page></home-page>
        </div>
        <footer>
            <p>Done by: Khalid Noman | Email: <a href="mailto:ksnoman@live.com">ksnoman@live.com</a></p>
        </footer>
    </body>
</html>
