document.addEventListener("DOMContentLoaded", function() {
    const navLinks = document.querySelectorAll('.nav-links a');
  
    // Función para agregar la clase "active" al elemento de navegación correspondiente
    const setActiveLink = (id) => {
        navLinks.forEach(link => {
            if (link.getAttribute('href') === `#${id}`) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    };
  
    // Agregar la clase "active" al hacer clic en un enlace
    navLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            navLinks.forEach(link => link.classList.remove('active'));
            this.classList.add('active');
        });
    });
  
    // Agregar la clase "active" al desplazarse a una sección
    window.addEventListener('scroll', function() {
        const scrollPosition = window.scrollY;
        document.querySelectorAll('section').forEach(section => {
            if (
                scrollPosition >= section.offsetTop - 100 &&
                scrollPosition < section.offsetTop + section.offsetHeight - 100
            ) {
                setActiveLink(section.id);
            }
        });
    });
});

window.addEventListener("scroll", function () {
    const nav = document.querySelector("header");
    const logo = document.getElementById("logo");

    if (window.scrollY > 113) {
      logo.src = "/images/logo/texto-logo-v1.png"; // Cambia al logo v3
      nav.classList.add("nav-scrolled");
    } else {
      logo.src = "/images/logo/texto-logo-white.png"; // Vuelve al logo original
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

  document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const navLinks = document.querySelectorAll('.nav-links a');

    navLinks.forEach(link => {
      link.addEventListener('click', function() {
        menuToggle.checked = false;
      });
    });
  });