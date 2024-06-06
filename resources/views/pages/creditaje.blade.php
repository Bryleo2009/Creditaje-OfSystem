
@extends('layouts.app')

@section('content')
<?php
// Encabezados para evitar el caché
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Incluir el archivo referer.php
//include 'api/referer.php';
?>
	<head>
		<title>Of System</title>		
		<meta name="description" content="Soluciones web personalizadas para impulsar tu presencia en línea y alcanzar el éxito digital.">
		<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	</head>

		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar" class="active">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary icono">
						<i class="fa fa-bars"></i>
						<span class="sr-only">Toggle Menu</span>
					</button>
				</div>
				<div class="p-4">
					<h1><a href="/" class="logo"><img src="{{ asset('images/logo/texto-logo-white.png') }}"
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
					<img class="h-100 w-100" src="{{ asset('images/fondo_credito.webp ') }}" alt>
				</div>
				<div class="conten-logo">
					<div class="logo">
						<img class="h-100 w-100" src="{{ asset('images/logo/logo-v2.png') }}" alt="logo of system">
					</div>
					<div class="texto">
						<img class="w-100" src="{{ asset('images/logo/texto-v1.png') }}" alt="texto of system">
					</div>
				</div>
				<div class="version ml-2">
					<p>Versión 2.4
						<br>Todos los derechos reservados <span id="year"></span></p>
				</div>
			</div>
		</div>

		<div id="WhatsBTN"></div>

@endsection