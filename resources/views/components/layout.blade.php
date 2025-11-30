<!DOCTYPE html>
    <html lang="lv">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $title ?? "Minigames" }}</title>
<link rel="stylesheet" href="{{ asset('css/typinggame.css') }}">
<link rel="stylesheet" href="{{ asset('css/minigames.css') }}">
    </head>
    <body>
        {{ $slot }}
    </body>
</html>