<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta>
        <title>Countymanager</title>
        <meta name="description" content="Megye és város kezelő adminisztrációs rendszer"/>
        <meta name="keywords" content="megye, város, adminisztráció"/>
        <meta name="author" content="starbuck" />
        <meta name="robots" content="follow"/>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <?php
        $apiKeyArray = json_encode([
            'apiKey' => $apiKey ?? null,
        ]);
        ?>
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
