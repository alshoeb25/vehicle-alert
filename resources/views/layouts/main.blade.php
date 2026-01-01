    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>@yield('title', 'Respo QR Codes')</title>
        <meta name="description" content="@yield('meta_description', 'Respo QR Codes - Vehicle Alerts')" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="icon" type="image/x-icon" href="/assets/images/RESPO-ico.ico">
        
        <!-- Vendor CSS -->
        <link rel="stylesheet" href="/assets/vendors/bootstrap/css/bootstrap.min.css" />
        <link rel="stylesheet" href="/assets/css/animate.min.css" />
        <link rel="stylesheet" href="/assets/vendors/owl-carousel/owl.carousel.min.css" />
        <link rel="stylesheet" href="/assets/vendors/owl-carousel/owl.theme.default.min.css" />
        <link rel="stylesheet" href="/assets/css/style.css" />
        <link rel="stylesheet" href="/assets/css/responsive.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @yield('content')
        
        <!-- Vendor JS -->
        <script src="/assets/vendors/jquery/jquery-3.6.0.min.js"></script>
        <script src="/assets/vendors/owl-carousel/owl.carousel.min.js"></script>
        <script src="/assets/vendors/wow/wow.js"></script>
        <script src="/assets/js/script.js"></script>
    </body>
    </html>
