<!DOCTYPE html>
<html lang="uk">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <title>СТО</title>
        <link href="/favicon.ico" rel="icon" type="image/png">
		<link href="/css/croppie.css" rel="stylesheet">
		<link href="/css/jquery.arcticmodal.css" rel="stylesheet">
		<link href="/css/modal.css" rel="stylesheet">
        <script src="https://unpkg.com/vue-silentbox@0.1.9/dist/vue-silentbox.min.js"></script>
    </head>
    <body>
        <div id="app">
            <header-component></header-component>
            <router-view></router-view>
            <footer-component></footer-component>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        <script src="{{ asset('js/croppie.min.js') }}"></script>
        <script src="{{ asset('js/jquery.arcticmodal.js') }}"></script>
    </body>
</html>
