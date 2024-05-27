//crea una funcion que reciba los campos de envio de correo
//y los envie a un archivo php para que este envie el correo
//y devuelva un mensaje de confirmacion
function enviarCorreo() {
    console.log("enviando correo");
    var nombre = document.getElementById("name").value;
    var correo = document.getElementById("email").value;
    var mensaje = document.getElementById("service").value;

    //si alguno es nulo
    if (nombre == "" || correo == "" || mensaje == "") {
        Swal.fire({
            title: "Error",
            text: "Por favor llene todos los campos",
            icon: "warning"
        });
        registrarLog("Error al enviar correo: campos vacios");
        return;
    }

    var parametros = {
        "name": nombre,
        "email": correo,
        "service": mensaje
    };

    // Envío del correo
    $.ajax({
        data: parametros,
        url: 'ofsystem/enviar.php',
        type: 'post',
        success: function (response) {
            // Llamar a enviarContacto y luego actualizarEstadoCorreo con el ID devuelto
            enviarContacto(nombre, correo, mensaje)
                .then(function (idContact) {
                    // Llamar a actualizarEstadoCorreo con el ID del contacto y el nuevo estado
                    actualizarEstadoCorreo(idContact, 'SENT')
                        .then(function () {
                            // Registro de éxito
                            registrarLog("Correo enviado correctamente");
                            // Mostrar mensaje de éxito al usuario
                            Swal.fire({
                                title: "Enviado",
                                text: "El correo ha sido enviado con éxito a nuestro sistema. Nos pondremos en contacto contigo lo más pronto posible. Verifica tu bandeja de entrada o spam.",
                                icon: "success"
                            }).then((result) => {
                                // Limpiar campos del formulario
                                document.getElementById("name").value = "";
                                document.getElementById("email").value = "";
                                document.getElementById("service").value = "";
                            });
                        })
                        .catch(function (error) {
                            // Manejar error de actualizarEstadoCorreo
                            registrarLog("Error al actualizar estado del correo: " + error);
                            Swal.fire({
                                title: "Error de envío",
                                text: "Hubo un error al actualizar el estado del correo, por favor inténtalo de nuevo más tarde.",
                                icon: "warning"
                            });
                        });
                })
                .catch(function (error) {
                    // Manejar error de enviarContacto
                    registrarLog("Error al enviar el correo: " + error);
                    Swal.fire({
                        title: "Error de envío",
                        text: "Hubo un error al enviar el correo, por favor inténtalo de nuevo más tarde.",
                        icon: "warning"
                    });
                });
        },
        error: function (error) {
            // Manejar error de enviar correo
            registrarLog("Error al enviar correo: " + error);
            Swal.fire({
                title: "Error de envío",
                text: "Hubo un error al enviar el correo, por favor inténtalo de nuevo más tarde.",
                icon: "warning"
            });
        }
    });

}


async function enviarContacto(nombre, email, servicio) {
    const response = await fetch('/api/guardar_contacto.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ name: nombre, email: email, service: servicio })
    });

    const result = await response.json();
    if (result.status === 'success') {
        registrarLog(`Contacto ${nombre}[${email}] guardado con ID: ${result.id}`);
        return result.id;
    } else {
        registrarLog(`Error al guardar contacto ${nombre}[${email}]: ${result.message}`);
    }
}

async function actualizarEstadoCorreo(idCliente, nuevoEstado) {
    const response = await fetch('/api/actualizar_estado_correo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id: idCliente, estado_correo: nuevoEstado })
    });

    const result = await response.json();
    if (result.status === 'success') {
        registrarLog(`Estado del correo del ID-${idCliente} actualizado correctamente`);
    } else {
        registrarLog(`Error al actualizar estado del correo del ID-${idCliente}: ${result.message}`);
    }
}
