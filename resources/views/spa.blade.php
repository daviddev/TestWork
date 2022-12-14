<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

        <style type="text/css">
            html, body, #v-app {
                height: 100%;
                margin: 0px;
                padding: 0px;
            }
        </style>
    </head>
    <body>
        <div id="v-app">
            <app/>
        </div>

        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
