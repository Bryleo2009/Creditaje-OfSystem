//crea una funcion que reciba los campos de envio de correo
//y los envie a un archivo php para que este envie el correo
//y devuelva un mensaje de confirmacion
function enviarCorreo() {
    var nombre = document.getElementById("name").value;
    var correo = document.getElementById("email").value;
    //obten el data-id-service del elemento con id plan
    var id_service = document.getElementById("plan").getAttribute('data-id-service');
    var id_catego = document.getElementById("plan").getAttribute('data-id-catego');

    //si alguno es nulo
    if (nombre == "" || correo == "") {
        Swal.fire({
            title: "Error",
            text: "Por favor llene todos los campos",
            icon: "warning"
        });
        return;
    }


    // Llamar a enviarContacto para crear el cliente y obtener su ID
    nuevoContacto(nombre, correo, id_service,id_catego)
        .then(function (idContact) {
            // Envío del correo
            var parametros = {
                "nombre": nombre,
                "email": correo,
                "id_service": id_service,
                "id_catego": id_catego,
                "idCliente": idContact
            };

            const csrfToken = getCsrfToken();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.ajax({
                data: parametros,
                url: '/api/frm_contacto',
                type: 'post',
                success: function (response) {
                    console.log(response);
                    // Llamar a actualizarEstadoCorreo con el ID del cliente y el nuevo estado
                    idContact = idContact + 'CLT';
                    actualizarEstadoCorreo(idContact, 'SENT')
                        .then(function () {
                            $("#spinner").hide();
                            // Mostrar mensaje de éxito al usuario
                            Swal.fire({
                                title: "Enviado",
                                text: "El correo ha sido enviado con éxito a nuestro sistema. Nos pondremos en contacto contigo lo más pronto posible. Verifica tu bandeja de entrada o spam.",
                                icon: "success"
                            }).then((result) => {
                                // Limpiar campos del formulario
                                document.getElementById("name").value = "";
                                document.getElementById("email").value = "";
                            });
                        })
                        .catch(function (error) {
                            $("#spinner").hide();
                            Swal.fire({
                                title: "Error de envío",
                                text: "Hubo un error al actualizar el estado del correo, por favor inténtalo de nuevo más tarde.",
                                icon: "warning"
                            });
                        });
                },
                error: function (error) {
                    logMessage('error',error.message);
                    Swal.fire({
                        title: "Error de envío",
                        text: "Hubo un error al enviar el correo, por favor inténtalo de nuevo más tarde.",
                        icon: "warning"
                    });
                }
            });
        })
        .catch(function (error) {
            logMessage('error',error);
            Swal.fire({
                title: "Error de envio",
                text: "Hubo un error al enviar el correo, por favor inténtalo de nuevo más tarde.",
                icon: "warning"
            });
        });
}