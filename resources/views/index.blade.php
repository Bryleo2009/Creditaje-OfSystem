
@extends('layouts.app')

@section('content')

<?php
// Encabezados para evitar el caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Incluir el archivo referer.php
// include 'api/referer.php';


// Incluye la función para cargar traducciones
include('translations/load_translation.php');

// obten el idioma actual del navegador
$current_language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

// Carga las traducciones para el idioma actual
$translations = load_translation($current_language);

if ($current_language == 'es') {
  $services = [
    'Profesional' => 'Servicios profesionales',
    'Tienda' => 'Tienda en línea',
    'Landing' => 'Landing page'
  ];
} else {
  $services = [
    'Profesional' => 'Professional services',
    'Tienda' => 'Online store',
    'Landing' => 'Landing page'
  ];
}

?>
<head>
  <!--metadatos-->
  <?php if ($current_language == 'es') : ?>
    <meta name="description" content="Soluciones web personalizadas para impulsar tu presencia en línea y alcanzar el éxito digital.">
  <?php else : ?>
    <meta name="description" content="Custom web solutions to boost your online presence and achieve digital success.">
  <?php endif; ?>
  <script type="text/javascript" src="{{ asset('js/nav.js') }}"></script>
  <link rel="stylesheet" href="{{ asset('css/home.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/what.css') }}">
  <!--título-->
  <title>Of System</title>
</head>

<body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5CDNJTBN" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <header>
    <nav class="nav">
      <div class="logo">
        <a href="/"><img id="logo" src="{{ asset('images/logo/texto-logo-v2.png') }}" alt="logo of system" /></a>
      </div>
      <input type="checkbox" id="menu-toggle" class="menu-toggle" />
      <label for="menu-toggle" class="menu-toggle-label">
        <i class="fa-solid fa-bars"></i>
        <i class="fa-solid fa-times"></i>
      </label>
      <ul class="nav-links gap-2">
        <li><a class="service-link" href="/"><?php echo $translations['inicio']; ?></a></li>
        <li><a class="service-link" href="#servicios"><?php echo $translations['servicios']; ?></a></li>
        <li><a class="service-link" href="#metodologia"><?php echo $translations['metodologia']; ?></a></li>
        <li><a class="service-link" href="#beneficios"><?php echo $translations['beneficios']; ?></a></li>
        <li><a class="service-link" href="#clientes"><?php echo $translations['clientes']; ?></a></li>
        <li><a class="service-link btn-contact" href="#contacto"><?php echo $translations['contacto']; ?></a></li>
      </ul>
    </nav>
  </header>

  <main>
    <!--Home-->
    <section class="home d-flex align-items-center" id="home">
      <div class="d-flex flex-column align-items-center">
        <div class="logo-2">
          <img src="{{ asset('images/logo/logo-white.png') }}" alt="logo of system" />
        </div>
        <h1 class="blanco center mb-4">
          <?php echo $translations['desarrollo']; ?>
          <?php 
            if($current_language == 'es'){
              ?>
              <span id="element" class="degradado degradado-1"></span>
              <span class="degradado degradado-1"><?php echo $translations['web']; ?></span><br />
              <?php
            } else {
              ?>
              <span class="degradado degradado-1"><?php echo $translations['web']; ?></span>
              <span id="element" class="degradado degradado-1"></span><br />
              <?php
            }
            ?>
          
          <span class="degradado degradado-1"><?php echo $translations['personalizadas']; ?></span>
          <?php echo $translations['reflejo']; ?>
        </h1>
        <p class="blanco center">
          <?php echo $translations['presencia']; ?>
        </p>
        <a type="button" class="btn-1" href="#contacto"><?php echo $translations['presupuesto']; ?></a>
      </div>
      <img src="{{ asset('images/landing/Group 19.webp') }}" alt="abst" class="fondo" />
    </section>
    <section class="video">
      <div class="espaciado center">
        <span class="vector">
          <svg viewBox="0 0 1034 545" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="63.8293" y="0.25" width="906.341" height="525.223" rx="16" fill="black" />
            <path d="M-0.00634766 517.888H1034.01V531.477C1034.01 531.477 1025.16 544.75 1008.41 544.75C991.66 544.75 517 544.75 517 544.75C517 544.75 46.7644 544.75 27.4873 544.75C8.21014 544.75 -0.00634766 531.477 -0.00634766 531.477V517.888Z" fill="#9A9996" />
            <path d="M441.788 517.888H592.212C592.212 526.266 585.421 533.057 577.044 533.057H456.956C448.579 533.057 441.788 526.266 441.788 517.888Z" fill="#77767B" />
          </svg>
        </span>
        <div class="d-flex flex-column mt-5" data-aos="zoom-in">
          <h1 class="degradado degradado-2"><?php echo $translations['marca']; ?></h1>
          <p class="blanco"><?php echo $translations['parrafo_marca']; ?>
          </p>
        </div>
      </div>
    </section>
    <span class="vector">
      <svg viewBox="0 0 1510 226" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 133.639L50.3333 161.701C100.667 190.291 201.333 245.625 302 217.958C402.667 190.29 503.333 76.9865 604 63.4164C704.667 49.3193 805.333 133.639 906 154.718C1006.67 175.798 1107.33 133.639 1208 133.639C1308.67 133.639 1409.33 175.798 1459.67 196.878L1510 217.958V-35H1459.67C1409.33 -35 1308.67 -35 1208 -35C1107.33 -35 1006.67 -35 906 -35C805.333 -35 704.667 -35 604 -35C503.333 -35 402.667 -35 302 -35C201.333 -35 100.667 -35 50.3333 -35H0V133.639Z" fill="#100F3C" />
      </svg>
    </span>

    <!--Servicios-->
    <section class="servicio" id="servicios">
      <div class="espaciado center">
        <h1>
          <?php echo $translations['una_opcion']; ?>
          <span class="degradado degradado-3"><?php echo $translations['resultados']; ?></span>
        </h1>
      </div>
      <div class="d-flex flex-wrap gap-2 justify-content-center mt-5">
        <?php foreach ($services as $value => $name) : ?>
          <div class="card-service" data-aos="fade-up">
            <div class="card-cabecera">
              <div class="ellipse">
                <!-- Puedes personalizar los íconos según el servicio -->
                <?php if ($value == 'Profesional') : ?>
                  <i class="fa-regular fa-building"></i>
                <?php elseif ($value == 'Tienda') : ?>
                  <i class="fa-regular fa-credit-card"></i>
                <?php elseif ($value == 'Landing') : ?>
                  <i class="fa-regular fa-flag"></i>
                <?php endif; ?>
              </div>
              <h2><?php echo $name; ?></h2>
            </div>
            <div class="card-cuerpo">
              <h3 class="placeholder-2">
                <!-- Aquí puedes poner descripciones personalizadas para cada servicio -->
                <?php if ($value == 'Profesional') : ?>
                  <?php echo $translations['profesional']; ?>
                <?php elseif ($value == 'Tienda') : ?>
                  <?php echo $translations['tienda']; ?>
                <?php elseif ($value == 'Landing') : ?>
                  <?php echo $translations['landing']; ?>
                <?php endif; ?>
              </h3>
            </div>
            <div class="card-pie">
              <a type="button" class="btn-2" href="#contacto" data-service="<?php echo $value; ?>"><?php echo $translations['emprezar']; ?></a>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!--Metodología-->
    <section class="metodologia" id="metodologia">
      <div class="espaciado center">
        <h1>
          <?php echo $translations['tu_web']; ?><span class="degradado degradado-4"><?php echo $translations['5_pasos']; ?></span>
        </h1>
        <p>
          <?php echo $translations['nuestra_metodologia']; ?>
        </p>
        <div class="d-flex flex-wrap justify-content-center gap-2 align-items-start">
          <div class="card-metod" data-aos="zoom-out">
            <i class="fa-solid fa-magnifying-glass-chart"></i>
            <h2><?php echo $translations['reunion']; ?><br /><?php echo $translations['analisis']; ?></h2>
            <h3 class="placeholder-2"><?php echo $translations['necesidades']; ?></h3>
          </div>
          <div class="card-metod" data-aos="zoom-out">
            <i class="fa-solid fa-pen-ruler"></i>
            <h2><?php echo $translations['diseño']; ?><br /><?php echo $translations['estrategico']; ?></h2>
            <h3 class="placeholder-2"><?php echo $translations['atractivo']; ?></h3>
          </div>
          <div class="card-metod" data-aos="zoom-out">
            <i class="fa-solid fa-code"></i>
            <h2><?php echo $translations['desarrollo_1']; ?><br /><?php echo $translations['especialidad']; ?></h2>
            <h3 class="placeholder-2"><?php echo $translations['contruccion']; ?></h3>
          </div>
          <div class="card-metod" data-aos="zoom-out">
            <i class="fa-solid fa-bug-slash"></i>
            <h2><?php echo $translations['pruebas']; ?><br /><?php echo $translations['optimizacion']; ?></h2>
            <h3 class="placeholder-2"><?php echo $translations['calidad']; ?></h3>
          </div>
          <div class="card-metod" data-aos="zoom-out">
            <i class="fa-solid fa-rocket"></i>
            <h2><?php echo $translations['lanzamiento']; ?><br /><?php echo $translations['exitoso']; ?></h2>
            <h3 class="placeholder-2">
              <?php echo $translations['en_linea']; ?>
            </h3>
          </div>
        </div>
      </div>
    </section>

    <!--Beneficios-->
    <section class="beneficios" id="beneficios">
      <div class="espaciado center">
        <div class="container-beneficios">
          <div class="A beneficio-sec beneficio-text">
            <h1 class="left"><?php echo $translations['valor']; ?></h1>
            <p class="placeholder-1 left">
              <?php echo $translations['nuestros_benedicios']; ?>
            </p>
          </div>
          <div class="B d-flex flex-column gap-2">
            <div class="item-benefic d-flex gap-1 align-items-center" data-aos="fade-right">
              <div class="ellipse">
                <i class="fa-solid fa-code"></i>
                <!-- <i class="fa-solid fa-eye"></i> -->
              </div>
              <h2 class="m-0 left pr-2"> <?php echo $translations['seo']; ?></h2>
            </div>
            <div class="item-benefic d-flex gap-1 align-items-center" data-aos="fade-right">
              <div class="ellipse">
                <i class="fa-solid fa-code"></i>
                <!-- <i class="fa-solid fa-envelope"></i> -->
              </div>
              <h2 class="m-0 left pr-2">
                <?php echo $translations['hosting']; ?>
              </h2>
            </div>
            <div class="item-benefic d-flex gap-1 align-items-center" data-aos="fade-right">
              <div class="ellipse">
                <i class="fa-solid fa-code"></i>
                <!-- <i class="fa-solid fa-bolt"></i> -->
              </div>
              <h2 class="m-0 left pr-2"><?php echo $translations['carga']; ?></h2>
            </div>
            <div class="item-benefic d-flex gap-1 align-items-center" data-aos="fade-right">
              <div class="ellipse">
                <i class="fa-solid fa-code"></i>
                <!-- <i class="fa-solid fa-lock"></i> -->
              </div>
              <h2 class="m-0 left pr-2"><?php echo $translations['seguridad']; ?></h2>
            </div>
            <div class="item-benefic d-flex gap-1 align-items-center" data-aos="fade-right">
              <div class="ellipse">
                <i class="fa-solid fa-code"></i>
                <!-- <i class="fa-solid fa-wand-magic-sparkles"></i> -->
              </div>
              <h2 class="m-0 left pr-2">
                <?php echo $translations['experiencia']; ?>
              </h2>
            </div>
          </div>
          <div class="C beneficio-sec beneficio-img">
            <img src="{{ asset('images/landing/beneficio.webp') }}" alt="beneficios" />
          </div>
        </div>
      </div>
    </section>
    <span class="vector">
      <svg viewBox="0 0 1510 403" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 8.38611L216.433 0L431.189 134.178L647.622 88.8928L862.378 6.70889L1078.81 90.57L1293.57 62.0572L1510 98.9561V402.533H1293.57H1078.81H862.378H647.622H431.189H216.433H0V8.38611Z" fill="#E6E6E9" />
        <path d="M0 191.203L216.433 129.146L431.189 169.399L647.622 83.8611L862.378 187.849L1078.81 110.697L1293.57 112.374L1510 155.982V402.533H1293.57H1078.81H862.378H647.622H431.189H216.433H0V191.203Z" fill="#ABAABC" />
        <path d="M0 139.209L216.433 164.368L431.189 231.456L647.622 216.361L862.378 162.69L1078.81 191.203L1293.57 184.494L1510 248.229V402.533H1293.57H1078.81H862.378H647.622H431.189H216.433H0V139.209Z" fill="#757290" />
        <path d="M0 261.647L216.433 293.514L431.189 275.065L647.622 288.482L862.378 226.425L1078.81 249.906L1293.57 286.805L1510 211.33V402.533H1293.57H1078.81H862.378H647.622H431.189H216.433H0V261.647Z" fill="#423E65" />
        <path d="M0 323.704L216.433 332.09L431.189 308.609L647.622 275.064L862.378 337.122L1078.81 348.862L1293.57 318.672L1510 313.641V402.533H1293.57H1078.81H862.378H647.622H431.189H216.433H0V323.704Z" fill="#100F3C" />
      </svg>
    </span>

    <!--Clientes-->
    <section class="clientes" id="clientes">
      <div class="espaciado center">
        <div>
          <div data-aos="zoom-in">
            <h1 class="blanco">
              <?php echo $translations['nuestros_1']; ?><span class="degradado degradado-5"><?php echo $translations['diseños_1']; ?></span><?php echo $translations['para_clientes']; ?>
            </h1>
            <p class="blanco">
              <?php echo $translations['explora']; ?>
            </p>
          </div>
          <div class="slider">
            <div class="slide-track">
              <div class="slide">
                <img src="{{ asset('images/landing/cap (1).webp') }}" alt />
              </div>
              <div class="slide">
                <img src="{{ asset('images/landing/cap (2).webp') }}" alt />
              </div>
              <div class="slide">
                <img src="{{ asset('images/landing/cap (5).webp') }}" alt />
              </div>
              <div class="slide">
                <img src="{{ asset('images/landing/cap (8).webp') }}" alt />
              </div>
              <div class="slide">
                <img src="{{ asset('images/landing/cap (9).webp') }}" alt />
              </div>

              <div class="slide">
                <img src="{{ asset('images/landing/cap (1).webp') }}" alt />
              </div>
              <div class="slide">
                <img src="{{ asset('images/landing/cap (2).webp') }}" alt />
              </div>
              <div class="slide">
                <img src="{{ asset('images/landing/cap (5).webp') }}" alt />
              </div>
              <div class="slide">
                <img src="{{ asset('images/landing/cap (8).webp') }}" alt />
              </div>
              <div class="slide">
                <img src="{{ asset('images/landing/cap (9).webp') }}" alt />
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!--Contacto-->
    <section class="contacto" id="contacto">
      <div class="espaciado center sec-contacto">
        <h1 class="blanco">
          <?php echo $translations['parte_de']; ?>
          <span class="degradado degradado-6"><?php echo $translations['exito']; ?></span>
        </h1>
        <form method="post" id="formContacto" class="mt-5 frm-contacto d-flex flex-wrap justify-content-evenly row-gap-2 align-items-center">
          <input type="text" name="name" id="name" class="col-md-3 col-12"
          <?php if ($current_language == 'es') : ?>
            placeholder="Nombre"
          <?php else : ?>
            placeholder="Name"
          <?php endif; ?>
           required />
          <input type="email" name="email" id="email" class="col-md-3 col-12" 
          <?php if ($current_language == 'es') : ?>
            placeholder="Correo"
          <?php else : ?>
            placeholder="Email"
          <?php endif; ?>
          required />
          <select class="custom-select col-md-3 col-12" name="service" id="service" required>
            <option value="" disabled selected><?php echo $translations['selecciona']; ?></option>
            <option value="Indeciso"><?php echo $translations['indeciso']; ?></option>
            <?php foreach ($services as $value => $name) : ?>
              <option value="<?php echo $value; ?>"><?php echo $name; ?></option>
            <?php endforeach; ?>
          </select>
          <button type="submit" class="btn-3 col-md-1 col-5">
            <i class="icon-btn-enviar fa-solid fa-angles-right"></i>
            <span class="text-btn-enviar"><?php echo $translations['enviar']; ?></span>
          </button>
        </form>
      </div>
    </section>
  </main>

  <footer>
    <section class="footer">
      <div class="sec-1">
        <div class="logo-footer">
          <img src="{{ asset('images/logo/logo-v1.png') }}" alt />
        </div>
        <div class="d-flex flex-column gap-1">
          <div class="footer-link d-flex">
            <a class="primary" href="/"><?php echo $translations['inicio']; ?></a>
            <a class="primary" href="#servicios"><?php echo $translations['servicios']; ?></a>
            <a class="primary" href="#metodologia"><?php echo $translations['metodologia']; ?></a>
            <a class="primary" href="#beneficios"><?php echo $translations['beneficios']; ?></a>
            <a class="primary" href="#clientes"><?php echo $translations['clientes']; ?></a>
            <a class="primary" href="/creditos"><?php echo $translations['creditaje']; ?></a>
          </div>
          <div class="footer-social gap-2">
            <a class="primary" href="https://www.facebook.com/OfSystem/" target="_blank"><i class='bx bxl-facebook-circle'></i></a>
            <a class="primary" href="https://www.instagram.com/ofsystem.soft/" target="_blank"><i class='bx bxl-instagram-alt'></i></a>
          </div>
        </div>
      </div>
      <div class="sec-2 py-3">
        <div class="contact">
          <div class="blanc d-flex gap-1 align-items-center texto-footer">
            <i class="fa-solid fa-envelope"></i>
            <h3 class="m-0">info@ofsystem.com.pe</h3>
          </div>
          <div class="blanco d-flex gap-1 align-items-center texto-footer">
            <i class="fa-solid fa-phone"></i>
            <h3 class="m-0">+51 907 442 751</h3>
          </div>
        </div>
        <div class="s-footer-social-copy">
          <script>
            var creditaje = 'ofsystem';
            var link = 'https://bryleo2009.github.io/Creditaje-OfSystem/';
            var text = '© All rights reserved - 2024';
            window.onload = document.write(
              '<' + creditaje + '>' +
              '<a href=' + '"' + link + '"' + 'target="_blank" >' + text +
              '</a>' +
              '</' + creditaje + '>');
          </script>
        </div>
        <div class="termino texto-footer">
          <h3><?php echo $translations['derechos']; ?><span id="year"></span></h3>
        </div>
      </div>
    </section>
  </footer>

  <div id="WhatsBTN"></div>
@endsection