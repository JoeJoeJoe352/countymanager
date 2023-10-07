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

        <?php
        $apiKeyArray = json_encode([
            'apiKey' => $apiKey ?? null,
        ]);
        ?>
    </head>
    <div class="container">
            <div id="home"></div>

    </div>


    <script src="{{ asset('/js/app.js') }}"></script>
</body>
</html>
