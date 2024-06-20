<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5CDNJTBN');
    </script>
    <!-- End Google Tag Manager -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="no-cache">
    <meta name="keywords"
        content="desarrollo web, diseño web, programación, sitios web, aplicaciones web, desarrollo de aplicaciones, diseño responsivo, experiencia de usuario, SEO, optimización web, HTML, CSS, JavaScript, PHP, WordPress, comercio electrónico, tiendas en línea, diseño de interfaces, desarrollo frontend, desarrollo backend, mantenimiento web,web development, web design, programming, websites, web applications, app development, responsive design, user experience, SEO, web optimization, HTML, CSS, JavaScript, PHP, WordPress, e-commerce, online stores, interface design, frontend development, backend development, web maintenance.">
    <meta name="theme-color" content="#ffffff">
    <meta name="robots" content="index, nofollow">
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="Spanish">
    <meta name="author" content="Bryan A. Morán Vega">
    <meta name="copyright" content="Of System ®">
    <meta name="theme-color" content="#302b63">
    <script src="https://kit.fontawesome.com/e3a4a2320e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="{{ asset('boostrap\css\bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

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
    <title>Of System</title>
</head>

<body>
    <div id="spinner" class="spinner">
        <span class="loader"></span>
    </div>
    @yield('content')
    <script src="{{ asset('boostrap\js\bootstrap.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/endpoints.js') }}"></script>
    <script src="{{ asset('js/contacto.js') }}"></script>
    <script src="{{ asset('js/ticket.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

    <script>
        <?php !isset($current_language) || $current_language == 'undefined' ? ($current_language = 'es') : $current_language; ?>


        <?php if ($current_language == 'es') : ?>
        var stringsArray = ["páginas", "experiencias", "aplicaciones", "soluciones"];
        <?php else : ?>
        var stringsArray = ["pages", "experiences", "applications", "solutions"];
        <?php endif; ?>

        var typed = new Typed("#element", {
            strings: stringsArray,
            typeSpeed: 70,
            backDelay: 2500,
            loop: true,
            showCursor: false,
        });

        <?php if ($current_language == 'es') : ?>
        var mensaje = "Hola! Dime, en que puedo ayudarte?";
        <?php else : ?>
        var mensaje = "Hi! Tell me, how can I help you?";
        <?php endif; ?>
        $(function() {
            $('#WhatsBTN').floatingWhatsApp({
                phone: '+51907442751', //WhatsApp numero, formato internacional
                headerTitle: 'Of System 💫', //Popup Titulo
                popupMessage: mensaje, //Popup Mensagem
                showPopup: true, //Desabilitar pop up
                buttonImage: '<span class="d-flex justify-content-center align-align-items-center" style="font-size: 36px; color: white"><i class=\'bx bxl-whatsapp\'></i></span>', //Button Image
                //headerColor: 'crimson', //Custom header color
                //backgroundColor: 'crimson', //Custom background button color
                position: "right",
                rightPosition: "10px", // Nueva variable para la posición derecha
                bottomPosition: "60px" // Nueva variable para la posición inferior   
            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('js/whats.js') }}"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
        });
    </script>
</body>

</html>
