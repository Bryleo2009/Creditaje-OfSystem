<!DOCTYPE html>
<html lang="es">

<head>
  <!--metadatos-->
  <meta name="description" content="Soluciones web personalizadas para impulsar tu presencia en línea y alcanzar el éxito digital.">
  <meta name="keywords" content="desarrollo web, diseño web, programación, sitios web, aplicaciones web, desarrollo de aplicaciones, diseño responsivo, experiencia de usuario, SEO, optimización web, HTML, CSS, JavaScript, PHP, WordPress, comercio electrónico, tiendas en línea, diseño de interfaces, desarrollo frontend, desarrollo backend, mantenimiento web,web development, web design, programming, websites, web applications, app development, responsive design, user experience, SEO, web optimization, HTML, CSS, JavaScript, PHP, WordPress, e-commerce, online stores, interface design, frontend development, backend development, web maintenance.">
  <?php require_once('pages/header.php'); ?>
  <link rel="stylesheet" href="css/home.css" />
  <!--título-->
  <title>Of System</title>
</head>

<body>

<header>
      <nav class="nav">
        <div class="logo">
          <a href="#home"
            ><img src="/images/Systen Logo 1.png" alt="logo of system"
          /></a>
        </div>
        <input type="checkbox" id="menu-toggle" class="menu-toggle" />
        <label for="menu-toggle" class="menu-toggle-label">
          <i class="fa-solid fa-bars"></i>
          <i class="fa-solid fa-times"></i>
        </label>
        <ul class="nav-links gap-2">
          <li><a class="service-link" href="#home">Inicio</a></li>
          <li><a class="service-link" href="#servicios">Servicios</a></li>
          <li><a class="service-link" href="#metodologia">Metodología</a></li>
          <li><a class="service-link" href="#beneficios">Beneficios</a></li>
          <li><a class="service-link" href="#clientes">Clientes</a></li>
          <li><a class="service-link" href="#contacto">Contacto</a></li>
        </ul>
      </nav>
    </header>

    <main>
      <!--Home-->
      <section class="home d-flex align-items-center" id="home">
        <div class="d-flex flex-column align-items-center">
          <h1 class="blanco center mb-4">
            Desarrollo de
            <span id="element" class="degradado degradado-1"></span>
            <span class="degradado degradado-1">web</span><br />
            <span class="degradado degradado-1">personalizadas</span>
            que reflejan la esencia de tu empresa
          </h1>
          <p class="blanco center">
            Eleva tu presencia digital con una experiencia web que deja una
            impresión duradera
          </p>
          <a type="button" class="btn-1" href="#contacto"
            >SOLICITAR PRESUPUESTO</a
          >
        </div>
        <img src="images/landing/Group 19.png" alt="abst" class="fondo" />
      </section>
      <section class="video">
        <div class="espaciado center">
          <span class="vector">
            <svg
              viewBox="0 0 1034 545"
              fill="none"
              xmlns="http://www.w3.org/2000/svg"
            >
              <rect
                x="63.8293"
                y="0.25"
                width="906.341"
                height="525.223"
                rx="16"
                fill="black"
              />
              <path
                d="M-0.00634766 517.888H1034.01V531.477C1034.01 531.477 1025.16 544.75 1008.41 544.75C991.66 544.75 517 544.75 517 544.75C517 544.75 46.7644 544.75 27.4873 544.75C8.21014 544.75 -0.00634766 531.477 -0.00634766 531.477V517.888Z"
                fill="#9A9996"
              />
              <path
                d="M441.788 517.888H592.212C592.212 526.266 585.421 533.057 577.044 533.057H456.956C448.579 533.057 441.788 526.266 441.788 517.888Z"
                fill="#77767B"
              />
            </svg>
          </span>
          <div class="d-flex flex-column mt-5">
            <h1 class="degradado degradado-2">¡Tú marca, tus reglas!</h1>
            <p class="blanco">
              Tener una presencia en línea efectiva es un desafío. Destacar
              entre la competencia y atraer la atención de tu audiencia puede
              ser complicado. En nuestra empresa, abordamos esos desafíos.
              Trabajamos de cerca contigo para transformar tus ideas en
              experiencias web sofisticadas y atractivas. Nuestra metodología
              meticulosa garantiza resultados de calidad que superan tus
              expectativas. Destaca, atrae y convierte a los visitantes en
              clientes con nuestra solución personalizada.
            </p>
          </div>
        </div>
      </section>
      <span class="vector">
        <svg
          viewBox="0 0 1510 226"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M0 133.639L50.3333 161.701C100.667 190.291 201.333 245.625 302 217.958C402.667 190.29 503.333 76.9865 604 63.4164C704.667 49.3193 805.333 133.639 906 154.718C1006.67 175.798 1107.33 133.639 1208 133.639C1308.67 133.639 1409.33 175.798 1459.67 196.878L1510 217.958V-35H1459.67C1409.33 -35 1308.67 -35 1208 -35C1107.33 -35 1006.67 -35 906 -35C805.333 -35 704.667 -35 604 -35C503.333 -35 402.667 -35 302 -35C201.333 -35 100.667 -35 50.3333 -35H0V133.639Z"
            fill="#100F3C"
          />
        </svg>
      </span>

      <!--Servicios-->
      <section class="servicio" id="servicios">
        <div class="espaciado center">
          <h1>
            Una opción, diferentes
            <span class="degradado degradado-3">resultados</span>
          </h1>
        </div>
        <div class="d-flex flex-wrap gap-2 justify-content-center mt-5">
          <div class="card-service">
            <div class="card-cabecera">
              <div class="ellipse">
                <i class="fa-regular fa-building"></i>
              </div>
              <h2>Servicios profesionales</h2>
            </div>
            <div class="card-cuerpo">
              <h3 class="placeholder-2">
                Presenta tus servicios profesionales de manera clara y
                convincente, captando la atención de clientes potenciales y
                estableciendo tu credibilidad en el mercado.
              </h3>
            </div>
            <div class="card-pie">
              <a type="button" class="btn-2" href="#contacto">Empezar</a>
            </div>
          </div>
          <div class="card-service">
            <div class="card-cabecera">
              <div class="ellipse">
                <i class="fa-regular fa-credit-card"></i>
              </div>
              <h2>Tienda en línea</h2>
            </div>
            <div class="card-cuerpo">
              <h3 class="placeholder-2">
                Abre las puertas de tu negocio al mundo digital y permite a tus
                clientes comprar tus productos o servicios en línea desde la
                comodidad de sus hogares.
              </h3>
            </div>
            <div class="card-pie">
              <a type="button" class="btn-2" href="#contacto">Empezar</a>
            </div>
          </div>
          <div class="card-service">
            <div class="card-cabecera">
              <div class="ellipse">
                <i class="fa-regular fa-flag"></i>
              </div>
              <h2>Landing page</h2>
            </div>
            <div class="card-cuerpo">
              <h3 class="placeholder-2">
                Captura la atención de tus visitantes y conviértelos en clientes
                potenciales con una página de aterrizaje optimizada y enfocada
                en una única oferta o llamada a la acción.
              </h3>
            </div>
            <div class="card-pie">
              <a type="button" class="btn-2" href="#contacto">Empezar</a>
            </div>
          </div>
        </div>
      </section>

      <!--Metodología-->
      <section class="metodologia" id="metodologia">
        <div class="espaciado center">
          <h1>
            Tu sitio web en <span class="degradado degradado-4">5 pasos</span>
          </h1>
          <p>
            Nuestra metodología paso a paso garantiza una experiencia de
            desarrollo web fluida y eficiente.
          </p>
          <div
            class="d-flex flex-wrap justify-content-center gap-2 align-items-start"
          >
            <div class="card-metod">
              <i class="fa-solid fa-magnifying-glass-chart"></i>
              <h2>Reunión y<br />análisis</h2>
              <h3 class="placeholder-2">Comprendiendo tus necesidades</h3>
            </div>
            <div class="card-metod">
              <i class="fa-solid fa-pen-ruler"></i>
              <h2>Diseño<br />estratégico</h2>
              <h3 class="placeholder-2">Creando atractivo visual</h3>
            </div>
            <div class="card-metod">
              <i class="fa-solid fa-code"></i>
              <h2>Desarrollo<br />especializado</h2>
              <h3 class="placeholder-2">Construyendo funcionalidad óptima</h3>
            </div>
            <div class="card-metod">
              <i class="fa-solid fa-bug-slash"></i>
              <h2>Pruebas y<br />optimización</h2>
              <h3 class="placeholder-2">Garantizando calidad y rendimiento</h3>
            </div>
            <div class="card-metod">
              <i class="fa-solid fa-rocket"></i>
              <h2>Lanzamiento<br />exitoso</h2>
              <h3 class="placeholder-2">
                Poniendo tu página web en línea y listo para impactar
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
              <h1 class="left">Valor y Eficiencia Garantizados</h1>
              <p class="placeholder-1 left">
                Al contratarnos, te brindamos beneficios exclusivos que
                impulsarán tu presencia en línea. Trabajamos siguiendo una
                metodología ágil basada en Scrum para ofrecerte resultados
                superiores y óptimos rendimientos. Además, te aseguramos
                soluciones de hospedaje confiables y de alta velocidad para una
                experiencia excepcional.
              </p>
            </div>
            <div class="B d-flex flex-column gap-2">
              <div class="item-benefic d-flex gap-1 align-items-center">
                <div class="ellipse">
                  <i class="fa-solid fa-code"></i>
                  <!-- <i class="fa-solid fa-eye"></i> -->
                </div>
                <h2 class="m-0 left pr-2">Mejora en SEO y visibilidad</h2>
              </div>
              <div class="item-benefic d-flex gap-1 align-items-center">
                <div class="ellipse">
                  <i class="fa-solid fa-code"></i>
                  <!-- <i class="fa-solid fa-envelope"></i> -->
                </div>
                <h2 class="m-0 left pr-2">
                  Generación de correos, dominios y hosting
                </h2>
              </div>
              <div class="item-benefic d-flex gap-1 align-items-center">
                <div class="ellipse">
                  <i class="fa-solid fa-code"></i>
                  <!-- <i class="fa-solid fa-bolt"></i> -->
                </div>
                <h2 class="m-0 left pr-2">Carga eficiente y rápida</h2>
              </div>
              <div class="item-benefic d-flex gap-1 align-items-center">
                <div class="ellipse">
                  <i class="fa-solid fa-code"></i>
                  <!-- <i class="fa-solid fa-lock"></i> -->
                </div>
                <h2 class="m-0 left pr-2">Seguridad y SSL</h2>
              </div>
              <div class="item-benefic d-flex gap-1 align-items-center">
                <div class="ellipse">
                  <i class="fa-solid fa-code"></i>
                  <!-- <i class="fa-solid fa-wand-magic-sparkles"></i> -->
                </div>
                <h2 class="m-0 left pr-2">
                  Experiencia intuitiva, diseño impactante
                </h2>
              </div>
            </div>
            <div class="C beneficio-sec beneficio-img">
              <img src="images/landing/beneficio.webp" alt="beneficios" />
            </div>
          </div>
        </div>
      </section>
      <span class="vector">
        <svg
          viewBox="0 0 1510 403"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M0 8.38611L216.433 0L431.189 134.178L647.622 88.8928L862.378 6.70889L1078.81 90.57L1293.57 62.0572L1510 98.9561V402.533H1293.57H1078.81H862.378H647.622H431.189H216.433H0V8.38611Z"
            fill="#E6E6E9"
          />
          <path
            d="M0 191.203L216.433 129.146L431.189 169.399L647.622 83.8611L862.378 187.849L1078.81 110.697L1293.57 112.374L1510 155.982V402.533H1293.57H1078.81H862.378H647.622H431.189H216.433H0V191.203Z"
            fill="#ABAABC"
          />
          <path
            d="M0 139.209L216.433 164.368L431.189 231.456L647.622 216.361L862.378 162.69L1078.81 191.203L1293.57 184.494L1510 248.229V402.533H1293.57H1078.81H862.378H647.622H431.189H216.433H0V139.209Z"
            fill="#757290"
          />
          <path
            d="M0 261.647L216.433 293.514L431.189 275.065L647.622 288.482L862.378 226.425L1078.81 249.906L1293.57 286.805L1510 211.33V402.533H1293.57H1078.81H862.378H647.622H431.189H216.433H0V261.647Z"
            fill="#423E65"
          />
          <path
            d="M0 323.704L216.433 332.09L431.189 308.609L647.622 275.064L862.378 337.122L1078.81 348.862L1293.57 318.672L1510 313.641V402.533H1293.57H1078.81H862.378H647.622H431.189H216.433H0V323.704Z"
            fill="#100F3C"
          />
        </svg>
      </span>

      <!--Clientes-->
      <section class="clientes" id="clientes">
        <div class="espaciado center">
          <div>
            <h1 class="blanco">
              Nuestros <span class="degradado degradado-5">Diseños</span> para
              Clientes Satisfechos
            </h1>
            <p class="blanco">
              Explora nuestra galería de diseños exclusivos y descubre los
              increíbles modelos que hemos creado para nuestros clientes.
            </p>
            <div class="slider">
              <div class="slide-track">
                <div class="slide">
                  <img src="images/landing/cap (1).png" alt />
                </div>
                <div class="slide">
                  <img src="images/landing/cap (2).png" alt />
                </div>
                <div class="slide">
                  <img src="images/landing/cap (5).png" alt />
                </div>
                <div class="slide">
                  <img src="images/landing/cap (8).png" alt />
                </div>
                <div class="slide">
                  <img src="images/landing/cap (9).png" alt />
                </div>

                <div class="slide">
                  <img src="images/landing/cap (1).png" alt />
                </div>
                <div class="slide">
                  <img src="images/landing/cap (2).png" alt />
                </div>
                <div class="slide">
                  <img src="images/landing/cap (5).png" alt />
                </div>
                <div class="slide">
                  <img src="images/landing/cap (8).png" alt />
                </div>
                <div class="slide">
                  <img src="images/landing/cap (9).png" alt />
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
            Contáctanos y déjanos ser parte de tu
            <span class="degradado degradado-6">éxito en línea</span>
          </h1>
          <form
            action="enviar.php"
            method="post"
            class="mt-5 frm-contacto d-flex flex-wrap justify-content-evenly row-gap-2 align-items-center"
          >
            <input
              type="text"
              name="nombre"
              class="col-md-5 col-12"
              placeholder="Nombre"
              required
            />
            <input
              type="email"
              name="correo"
              class="col-md-5 col-12"
              placeholder="Correo"
              required
            />
            <select class="custom-select col-md-3 col-12" name="service" required>
                <option selected disabled>Selecciona un servicio</option>
                <option value="0">Aun no estoy seguro</option>
                <option value="1">Servicios profesionales</option>
                <option value="2">Tienda en línea</option>
                <option value="3">Landing page</option>
              </select>
            <button type="submit" class="btn-3 col-md-1 col-5">
              <i class="icon-btn-enviar fa-solid fa-angles-right"></i>
              <span class="text-btn-enviar">Enviar</span>
            </button>
          </form>
        </div>
      </section>
    </main>

    <footer>
      <section class="footer">
        <div class="sec-1">
            <div class="logo-footer">
                <img src="/images/landing/System.png" alt />
            </div>
          <div class="d-flex flex-column gap-1">
            <div class="footer-link d-flex">
              <a class="primary" href="#home">Inicio</a>
              <a class="primary" href="#servicios">Servicios</a>
              <a class="primary" href="#metodologia">Metodología</a>
              <a class="primary" href="#beneficios">Beneficios</a>
              <a class="primary" href="#clientes">Clientes</a>
              <a class="primary" href="/creditos.php">Creditaje</a>
            </div>
            <div class="footer-social gap-2">
              <a class="primary" href="https://www.facebook.com/OfSystem/" target="_blank"
                ><i class='bx bxl-facebook-circle' ></i></a>
              <a class="primary" href="https://www.instagram.com/ofsystem.soft/" target="_blank"
                ><i class='bx bxl-instagram-alt'></i></a>
            </div>
          </div>
        </div>
        <div
          class="sec-2 py-3"
        >
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
          <div class="termino texto-footer">
            <h3 class="m-0">
              © 2021 Of System. Todos los derechos reservados.
            </h3>
          </div>
        </div>
      </section>
    </footer>

    <!-- Load library from the CDN -->
    <script src="https://unpkg.com/typed.js@2.1.0/dist/typed.umd.js"></script>

    <!-- Setup and start animation! -->
    <script>
      var typed = new Typed("#element", {
        strings: ["páginas", "experiencias", "aplicaciones", "soluciones"],
        typeSpeed: 70,
        backDelay: 2500,
        loop: true,
        showCursor: false,
      });
    </script>
    <script>
      window.addEventListener("scroll", function () {
        const nav = document.querySelector("header");
        if (window.scrollY > 113) {
          // Cambia el color si el scroll es mayor a 0
          nav.classList.add("nav-scrolled");
        } else {
          nav.classList.remove("nav-scrolled");
        }

        const serviceLinks = document.querySelectorAll(".service-link");
        window.addEventListener("scroll", () => {
          if (window.scrollY > 113) {
            serviceLinks.forEach((link) => {
              link.classList.add("service-link-scrolled");
              //link.classList.add('primary');
            });
          } else {
            serviceLinks.forEach((link) => {
              //link.classList.remove('primary');
              link.classList.remove("service-link-scrolled");
            });
          }
        });
      });
    </script>
  <?php require_once 'pages/footer.php'; ?>
</body>

</html>