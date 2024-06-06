(function($) {

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
  });

})(jQuery);

document.addEventListener('DOMContentLoaded', function() {
	document.querySelectorAll('.btn-2').forEach(button => {
	  button.addEventListener('click', function() {
		const serviceValue = this.getAttribute('data-service');
		document.getElementById('service').value = serviceValue;
	  });
	});
  });

  const yearElement = document.getElementById('year');
  const currentYear = new Date().getFullYear();
  yearElement.textContent = `- Of System © ${currentYear} `;
  
  document.getElementById("formContacto").addEventListener("submit", function(e) {
	e.preventDefault(); // Evita que el formulario se envíe de manera convencional
	enviarCorreo(); // Llama a la función enviarCorreo()
  });
