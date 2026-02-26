<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <!--google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&family=Vollkorn:ital,wght@0,400..900;1,400..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />

    <link href="{{asset('favicon.ico')}}" rel="icon">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
    @yield('csslink')

</head>


@if (session('status'))
    <div id="toast" class="toast-message {{ session('status_type') === 'error' ? 'error' : '' }}">
        {{ session('status') }}
        <span class="close-btn" onclick="hideToast()">&times;</span>
    </div>
@endif

<body>
    @include("layout.partials.navbar")
    <main>
        @yield('main')
    </main>
    @include("layout.partials.footer")
</body>

@yield('jslink')
<script src="{{ asset('js/notification.js') }}"></script>
<script src="{{ asset('js/navbar.js') }}"></script>
<script src="{{ asset('js/termosscript.js') }}"></script>
<script src="{{ asset('js/maremrisco.js') }}"></script>
<script src="{{ asset('js/faq.js') }}"></script>
<script src="{{ asset('js/voluntarios.js') }}"></script>

</html>