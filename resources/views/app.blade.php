<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        @if (env('GOOGLE_REBOT_BAN', false))
          <meta name="robots" content="noindex, nofollow">
          <meta name="googlebot" content="noindex">
        @endif

        <title inertia>{{ config('app.name', '國中小排課系統範例') }}</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.min.css" integrity="sha256-h2Gkn+H33lnKlQTNntQyLXMWq7/9XI2rlPCsLsVcUBs=" crossorigin="anonymous">

        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.6/dist/sweetalert2.all.min.js" integrity="sha256-dyw4h6gMbTk1vSiOqcs/wqhyqydsuILBl78WhcD44lY=" crossorigin="anonymous"></script>
    </body>
</html>
