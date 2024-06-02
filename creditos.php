<?php
// Encabezados para evitar el caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Incluir el archivo referer.php
include 'api/referer.php';
?>
<!doctype html>
<html lang="es">

	<head>
		<title>Of System</title>
		
		<meta name="description" content="Soluciones web personalizadas para impulsar tu presencia en línea y alcanzar el éxito digital.">
		<?php require_once('pages/header.php'); ?>
		<link rel="stylesheet" href="css/style.css">
	</head>

	<body>
		<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5CDNJTBN"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" class="active">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary icono">
						<i class="fa fa-bars"></i>
						<span class="sr-only">Toggle Menu</span>
					</button>
				</div>
				<div class="p-4">
					<h1><a href="/" class="logo"><img src="images/logo/texto-logo-white.png"
					alt="logo of system" width="200px"></a></h1>
					<ul class="list-unstyled components mb-5">
						<li class="active">
							<a href="/"><i class='bx bxs-home'></i> Inicio</a>
						</li>
						<!-- <li>
							<a href="https://github.com/Bryleo2009" target="_blank"><i
									class='bx bxl-github'></i> Github</a>
						</li> -->
						<li>
							<a href="https://www.facebook.com/OfSystem/" target="_blank"><i
									class='bx bxl-facebook-circle'></i> Facebook</a>
						</li>
						<li>
							<a href="https://www.instagram.com/ofsystem.soft/" target="_blank"><i
									class='bx bxl-instagram-alt'></i> Instagram</a>
						</li>
						<li>
							<a href="https://ofsystem.com.pe/reservas" target="_blank"><i
									class='bx bxs-calendar-event'></i> Reservas</a>
						</li>
					</ul>

					<div class="footer">
						<p>
							Página web creada por <br> Of System ®
						</p>
					</div>

				</div>
			</nav>

			<!-- Page Content  -->
			<div id="content" class="h-full w-full">
				<div class="fondo">
					<img class="h-100 w-100" src="images/Vector 01.png" alt>
				</div>
				<div class="conten-logo">
					<div class="logo">
						<img class="h-100 w-100" src="images/logo/logo-v2.png" alt="logo of system">
					</div>
					<div class="texto">
						<img class="w-100" src="images/logo/texto-v1.png" alt="texto of system">
					</div>
				</div>
				<div class="version ml-2">
					<p>Versión 2.4
						<br>Todos los derechos reservados <span id="year"></span></p>
				</div>
			</div>
		</div>

		<div id="WhatsBTN"></div>

		<?php require_once 'pages/footer.php'; ?>
		<script>
			$(function() {
				$('#WhatsBTN').floatingWhatsApp({
				phone: '+51907442751', //WhatsApp numero, formato internacional
				headerTitle: 'Of System 💫', //Popup Titulo
				popupMessage: 'Hola! Dime, en que puedo ayudarte?', //Popup Mensagem
				showPopup: true, //Desabilitar pop up
				buttonImage: '<img src="https://static-00.iconduck.com/assets.00/whatsapp-icon-2048x2048-64wjztht.png" />', //Button Image
				//headerColor: 'crimson', //Custom header color
				//backgroundColor: 'crimson', //Custom background button color
				position: "right"   ,
				rightPosition: "5px", // Nueva variable para la posición derecha
        		bottomPosition: "58px" // Nueva variable para la posición inferior  
				});
			});
		</script>
		<!-- <script>
			document.addEventListener("DOMContentLoaded", function() {
				var lastUpdated = document.lastModified;
				var lastUpdatedElement = document.getElementById("last-updated");
				if (lastUpdatedElement) {
				lastUpdatedElement.textContent = lastUpdated;
				}
			});
		</script> -->
		<script type="text/javascript" src="js/whats.js"></script>
	</body>

</html>
