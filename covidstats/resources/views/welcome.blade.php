<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/js/app.js')
    </head>

    <body>
        @vite('resources/js/app.js')
        <div id="app">
            <h1>Covid Statistical Data</h1>
            <landing-stats></landing-stats>
            <h1>Map</h1>
            <covid-map></covid-map>
        </div>
    </body>
</html>
