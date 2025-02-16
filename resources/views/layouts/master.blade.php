<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('logo.svg') }}" type="image/x-icon">
    <title>JobThan</title>

    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet" />
    <!-- CSS for carousel/flickity-->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
</head>

<body class="font-poppins">
    @if (!in_array(Route::currentRouteName(), ['login', 'register']))
        @if (in_array(Route::currentRouteName(), ['front.index']))
        <div id="page-background" class="absolute h-[1330px] w-full top-0 -z-10 overflow-hidden">
            <img src="{{asset('assets/backgrounds/Group 2009.png')}}" class="object-fill w-full h-full" alt="background">
        </div>
        @elseif (in_array(Route::currentRouteName(), ['front.search']))
        <div id="page-background" class="absolute h-[863px] w-full top-0 -z-10 overflow-hidden">
            <img src="{{asset('assets/backgrounds/Group 2009.png')}}" class="object-fill w-full h-full" alt="background">
        </div>
        @else
        <div id="page-background" class="absolute h-[533px] w-full top-0 -z-10 overflow-hidden">
            <img src="{{ asset('assets/backgrounds/Group 2009.png')}}" class="object-fill w-full h-full" alt="background">
        </div>
        @endif
    @endif
    <header>
        @if (!in_array(Route::currentRouteName(), ['login', 'register']))
        @include('partials.navbar')
        @endif
    </header>
    @yield('content')
    @include('partials.footer')
    @yield('scripts')

    <!-- JS for carousel/flickity-->
    <script src="{{ asset('js/navbar.js') }}"></script>
</body>

</html>