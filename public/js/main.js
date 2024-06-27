$("#spinner").hide();

(function ($) {

	"use strict";

	var fullHeight = function () {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function () {
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
		$('#sidebar').toggleClass('active');
	});

	$('.btn-2').click(function () {
		var id_service = $(this).data('id-service');
		var id_catego = $(this).data('id-catego');
		$('#plan').attr('data-id-service', id_service);
        $('#plan').attr('data-id-catego', id_catego);	
	});

})(jQuery);

const yearElement = document.getElementById('year');
const currentYear = new Date().getFullYear();
yearElement.textContent = `- Of System © ${currentYear} `;

document.getElementById("formContacto").addEventListener("submit", function (e) {
	$("#spinner").show();
	e.preventDefault(); // Evita que el formulario se envíe de manera convencional
	enviarCorreo(); // Llama a la función enviarCorreo()
});

showCategories(4);

function showCategories(servicioId) {

	//selecciona al servicio con data-id igual a servicioId
	const selectedService = document.querySelector(`.card-servicio[data-id="${servicioId}"]`);
	//agregale la clase card-active y a los otros la clase card-inactive
	document.querySelectorAll('.card-servicio').forEach(function (element) {
		element.classList.remove('card-active');
		element.classList.add('card-inactive');
	});

	selectedService.classList.remove('card-inactive');
	selectedService.classList.add('card-active');


	// Ocultar todas las categorías menos la del servicio 1
	document.querySelectorAll('.categories').forEach(function (element) {
		element.classList.remove('d-block');
		element.classList.add('d-none');
	});

	// Mostrar las categorías del servicio seleccionado
	const selectedCategories = document.getElementById(`categories-${servicioId}`);
	if (selectedCategories) {
		selectedCategories.classList.remove('d-none');
		selectedCategories.classList.add('d-block');
	}
}

const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

var video = document.getElementById('video');

var options = {
	root: null, // viewport
	rootMargin: '0px',
	threshold: 0.5 // Play video when 50% of it is visible
};

var observer = new IntersectionObserver(function(entries, observer) {
	entries.forEach(entry => {
		if (entry.isIntersecting) {
			video.play();
		} else {
			video.pause();
		}
	});
}, options);

observer.observe(video);