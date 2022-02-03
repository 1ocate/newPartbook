<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-17MSL1BZRK"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-17MSL1BZRK');
        </script>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

         <!-- meta for share or search -->
        <meta property="og:url" content="https://partbook.id/">
        <meta property="og:title" content="PARTBOOK.ID - Informasi Sparepart Mesin Produksi terlengkap dan terupdate">
        <meta property="og:type" content="website">
        <meta property="og:image" content="{{ secure_asset('favicon/apple-icon-180x180.png')}}">
        <meta property="og:description" content="site pertama referensi part no mesin yang akurat dengan standard international.">

        <meta name="description" content="site pertama referensi part no mesin yang akurat dengan standard international.">
        <meta name="keywords" content="partbook,part">

        <title>PARTBOOK.ID - Informasi Sparepart Mesin Produksi terlengkap dan terupdate</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
