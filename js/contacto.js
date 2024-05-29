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


    // Llamar a enviarContacto para crear el cliente y obtener su ID
    nuevoContacto(nombre, correo, mensaje)
        .then(function (idContact) {
            // Envío del correo
            var parametros = {
                "name": nombre,
                "email": correo,
                "service": mensaje,
                "idCliente": idContact
            };

            $.ajax({
                data: parametros,
                url: 'ofsystem/enviar.php',
                type: 'post',
                success: function (response) {
                    console.log(response);
                    registrarLog(response);
                    // Llamar a actualizarEstadoCorreo con el ID del cliente y el nuevo estado
                    actualizarEstadoCorreo(idContact, 'SENT')
                        .then(function () {
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
                            Swal.fire({
                                title: "Error de envío",
                                text: "Hubo un error al actualizar el estado del correo, por favor inténtalo de nuevo más tarde.",
                                icon: "warning"
                            });
                        });
                },
                error: function (error) {
                    console.log(error);
                    registrarLog(error);
                    Swal.fire({
                        title: "Error de envío",
                        text: "Hubo un error al enviar el correo, por favor inténtalo de nuevo más tarde.",
                        icon: "warning"
                    });
                }
            });
        })
        .catch(function (error) {
            registrarLog(error);
            Swal.fire({
                title: "Error de envio",
                text: "Hubo un error al enviar el correo, por favor inténtalo de nuevo más tarde.",
                icon: "warning"
            });
        });
}