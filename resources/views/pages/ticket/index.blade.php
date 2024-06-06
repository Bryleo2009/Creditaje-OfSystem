<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5CDNJTBN');</script>
    <!-- End Google Tag Manager -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="no-cache">
    <meta name="keywords" content="desarrollo web, diseño web, programación, sitios web, aplicaciones web, desarrollo de aplicaciones, diseño responsivo, experiencia de usuario, SEO, optimización web, HTML, CSS, JavaScript, PHP, WordPress, comercio electrónico, tiendas en línea, diseño de interfaces, desarrollo frontend, desarrollo backend, mantenimiento web,web development, web design, programming, websites, web applications, app development, responsive design, user experience, SEO, web optimization, HTML, CSS, JavaScript, PHP, WordPress, e-commerce, online stores, interface design, frontend development, backend development, web maintenance.">
    <meta name="theme-color" content="#ffffff">
    <meta name="robots" content="index, nofollow">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="Spanish">
    <meta name="author" content="Bryan A. Morán Vega">
    <meta name="copyright" content="Of System ®">
    <meta name="theme-color" content="#302b63">
    <script src="https://kit.fontawesome.com/e3a4a2320e.js" crossorigin="anonymous"></script>
    <script
    src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link
    href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900"
    rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css'
    rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link
          rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        />
    <link rel="stylesheet" href="{{ asset('boostrap\css\bootstrap.min.css')}}">
    
    
    <!-- Apple Touch Icons -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('images/favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('images/favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('images/favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('images/favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('images/favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-icon-180x180.png') }}">
    <meta name="title" content="Of System">
    
    <!-- Favicon Icons -->
    <link rel="icon" href="{{ asset('images/favicon/favicon.ico') }}">
    
    <!-- Microsoft Icons -->
    <meta name="msapplication-TileImage" content="{{ asset('images/favicon/ms-icon-70x70.png') }}">
    <meta name="msapplication-square70x70logo" content="{{ asset('images/favicon/ms-icon-70x70.png') }}">
    <meta name="msapplication-TileImage" content="{{ asset('images/favicon/ms-icon-144x144.png') }}">
    <meta name="msapplication-square144x144logo" content="{{ asset('images/favicon/ms-icon-144x144.png') }}">
    <meta name="msapplication-square150x150logo" content="{{ asset('images/favicon/ms-icon-150x150.png') }}">
    <meta name="msapplication-wide310x150logo" content="{{ asset('images/favicon/ms-icon-310x150.png') }}">
    <meta name="msapplication-square310x310logo" content="{{ asset('images/favicon/ms-icon-310x310.png') }}">
    
    <script src="{{ asset('js/log.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--título-->
    <title>Ticket | Of System</title>
    <link rel="stylesheet" href="{{ asset('css/ticket.css')}}">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('images/logo/texto-logo-v2.png')}}" alt="logo-ofsystem" width="170" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link blanco" id="new" aria-current="page" href="{{ route('new_ticket', ['ofsys' => $ofsys]) }}">Nuevo Ticket</a>
                        <a class="nav-link blanco" id="view" href="{{ route('client_tickets', ['ofsys' => $ofsys]) }}">Mis Tickets</a>
                    </div>
                </div>
            </div>
        </nav>
</header>
    <main>
        @yield('content')
    </main>
    <script src="{{ asset('boostrap\js\bootstrap.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/endpoints.js') }}"></script>
    <script src="{{ asset('js/contacto.js') }}"></script>
    <script src="{{ asset('js/ticket.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>
</body>

</html>