<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Countymanager</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="container">
            <div class="row header">
                <div class="logo-div col-lg-2">
                    <img src="/images/Counties_of_Hungary_2020.png"/>
                </div>
                <div class="title-div col-lg-4">
                    <h1>Megyekezelő</h1>
                </div>
                <div id="home"></div>
            </div>
        </div>

        <script>
            window.Laravel = {!! json_encode([
                    'apiKey' => $apiKey ?? null,
            ]) !!}
            ;
        </script>
        <script src="{{ asset('/js/app.js') }}"></script>
    </body>
</html>
