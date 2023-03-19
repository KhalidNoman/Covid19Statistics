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
            {{-- <h1>Covid Statistical Data</h1>
            <landing-stats></landing-stats>
            <h1>Map</h1>
            <covid-map></covid-map>
            <h1>Table</h1>
            <covid-table></covid-table> --}}
        </div>
    </body>
</html>
