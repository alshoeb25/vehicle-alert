<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>@yield('title', 'Respo QR Codes')</title>
    <meta name="description" content="@yield('meta_description', 'Respo QR Codes - Vehicle Alerts')" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="icon" type="image/x-icon" href="/assets/images/RESPO-ico.ico">
    <style>
        html, body {
            overflow-x: hidden !important;
            max-width: 100vw !important;
            margin: 0;
            padding: 0;
        }
        
        body {
            margin-top: 80px;
            padding-top: 0;
        }
        
        * {
            box-sizing: border-box;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        <nav>
            <a href="/">Home</a>
            <a href="/about">About</a>
            <a href="/shop">Shop</a>
            <a href="/how-it-works">How It Works</a>
            <a href="/contact">Contact</a>
            <a href="/faq">FAQ's</a>
            @auth
                <form action="{{ route('logout') }}" method="POST" style="display:inline">
                    @csrf
                    <button>Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>
