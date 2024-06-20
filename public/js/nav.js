document.addEventListener("DOMContentLoaded", function() {
  const navLinks = document.querySelectorAll('.nav-links a');
  const menuToggle = document.getElementById('menu-toggle');
  const header = document.querySelector("header");
  const logo = document.getElementById("logo");
  const serviceLinks = document.querySelectorAll(".service-link");

  const setActiveLink = (id) => {
      navLinks.forEach(link => {
          link.classList.remove('active');
          if (link.getAttribute('href') === `#${id}`) {
              link.classList.add('active');
          }
      });
  };

  const toggleLogoAndNav = () => {
    if (window.scrollY > 113) {
      if (window.innerWidth <= 769) {
        logo.src = "/images/logo/texto-logo-v2.png"; // Cambia al logo v1
      } else {
        logo.src = "/images/logo/texto-logo-v1.png"; // Cambia al logo v2
      }
      header.classList.add("nav-scrolled");
      serviceLinks.forEach(link => link.classList.add("service-link-scrolled"));
    } else {
      logo.src = "/images/logo/texto-logo-v2.png"; // Vuelve al logo original
      //nav.classList.remove("nav-scrolled");
      header.classList.remove("nav-scrolled");
      serviceLinks.forEach(link => link.classList.remove("service-link-scrolled"));
    }
  };

  const handleScroll = () => {
      toggleLogoAndNav();

      const scrollPosition = window.scrollY;
      document.querySelectorAll('section').forEach(section => {
          if (scrollPosition >= section.offsetTop - 100 && scrollPosition < section.offsetTop + section.offsetHeight - 100) {
              setActiveLink(section.id);
          }
      });
  };

  // Smooth scroll
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function(e) {
          e.preventDefault();

          const targetId = this.getAttribute('href').substr(1);
          const targetSection = document.getElementById(targetId);

          window.scrollTo({
              top: targetSection.offsetTop - 50,
              behavior: 'smooth'
          });
      });
  });

  window.addEventListener('scroll', handleScroll);

  navLinks.forEach(link => {
      link.addEventListener('click', function() {
          menuToggle.checked = false;
      });
  });
});