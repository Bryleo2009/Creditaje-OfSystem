<!DOCTYPE html>
<html>
    <head>
        <!--metadatos-->
        <meta name="description" content="Soluciones web personalizadas para impulsar tu presencia en línea y alcanzar el éxito digital.">
        <?php require_once('pages/header.php'); ?>
        <!--título-->
        <title>Login - Of System</title>
    </head>
<body>
    <style>
        .container {
            width: 100vw;
            display: flex;
            height: 100vh;
            flex-direction: column;
            justify-content: center;
        }
    </style>
    <div class="container">
        <h2>Iniciar sesión</h2>
        <form id="form">
            <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        </form>
    </div>

    <?php require_once 'pages/footer.php'; ?>
    <script>
        // Obtener el formulario
        const form = document.querySelector('form');
        
        // Agregar un evento de envío al formulario
        form.addEventListener('submit', async (event) => {
    event.preventDefault();
    
    // Obtener los datos del formulario
    const email = form.email.value;
    const password = form.password.value;
    
    try {
        // Enviar los datos al servidor y esperar la respuesta
        const response = await iniciarSesion(email, password);
        
        // Verificar la respuesta del servidor
        if (response.status === 'success') {
            window.location.href = 'pages/admin';
        } else {
            console.log(response);
            Swal.fire({
                title: "Error",
                text: response,
                icon: "warning"
            });
        }
    } catch (error) {
        // Manejar errores de red u otros errores
        console.error('Error al iniciar sesión:', error);
        Swal.fire({
            title: "Error",
            text: "Hubo un error al intentar iniciar sesión.",
            icon: "error"
        });
    }
});

    </script>

</body>
</html>