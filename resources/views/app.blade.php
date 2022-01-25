<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        <!-- Scripts -->
        @routes
        <script src="{{ mix('js/app.js') }}" defer></script>

        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-DE36YTFR3F"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-DE36YTFR3F');
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="py-2 text-center font-bold text-sm bg-green-500 text-white">The database content for this demo app will be refreshed every 15 mins.</div>
        @inertia
        <script>
            window.AppCurrency = "{{ config('finance.currency') }}";
            window.AppSmsTemplates = "{{ implode('\n', config('finance.sms_templates')) }}";
        </script>
    </body>
</html>
