<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="no-cache">
    <meta name="keywords" content="desarrollo web, diseño web, programación, sitios web, aplicaciones web, desarrollo de aplicaciones, diseño responsivo, experiencia de usuario, SEO, optimización web, HTML, CSS, JavaScript, PHP, WordPress, comercio electrónico, tiendas en línea, diseño de interfaces, desarrollo frontend, desarrollo backend, mantenimiento web,web development, web design, programming, websites, web applications, app development, responsive design, user experience, SEO, web optimization, HTML, CSS, JavaScript, PHP, WordPress, e-commerce, online stores, interface design, frontend development, backend development, web maintenance.">
    <script src="https://kit.fontawesome.com/e3a4a2320e.js" crossorigin="anonymous"></script>
    <script
    src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css'
    rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link
          rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        />
    <link rel="stylesheet" href="{{ asset('boostrap\css\bootstrap.min.css')}}">
    

    <!-- Favicon Icons -->
    <link rel="icon" href="{{ asset('images/favicon/favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
    <script src="{{ asset('js/log.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--título-->
    <title>Ticket | Of System</title>
    <link rel="stylesheet" href="{{ asset('css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('css/ticket.css')}}">

</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="https://ofsystem.com.pe" target="_blank">
                    <img src="{{ asset('images/logo/texto-logo-v2.png')}}" alt="logo-ofsystem" width="170" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link blanco" id="new" aria-current="page" href="/tck/new/{{ $ofsys }}">Nuevo Ticket</a>
                        <a class="nav-link blanco" id="view" href="/tck/client/{{ $ofsys }}">Mis Tickets</a>
                    </div>
                </div>
            </div>
        </nav>
</header>
<div id="spinner" class="spinner">
    <span class="loader"></span>
</div>
    <main>
        @yield('content')
    </main>
    <span id="year" style="display: none"></span>
    <script src="{{ asset('boostrap\js\bootstrap.js') }}"></script>
    <script src="{{ asset('js/popper.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/endpoints.js') }}"></script>
    <script src="{{ asset('js/contacto.js') }}"></script>
    <script src="{{ asset('js/ticket.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>