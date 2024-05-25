//crea una funcion que reciba los campos de envio de correo
//y los envie a un archivo php para que este envie el correo
//y devuelva un mensaje de confirmacion
function enviarCorreo() {
    console.log("enviando correo");
    var nombre = document.getElementById("name").value;
    var correo = document.getElementById("email").value;
    var mensaje = document.getElementById("service").value;
    var parametros = {
        "name": nombre,
        "email": correo,
        "service": mensaje
    };
    $.ajax({
        data: parametros,
        url: 'ofsystem/enviar.php',
        type: 'post',
        success: function(response) {
            Swal.fire({
                title: "Enviado",
                text: "El correo ha sido enviado con exito a nuestro sistema. Nos pondremos en contacto con usted lo mas pronto posible. Verifica tu bandeja de entrada o spam.",
                icon: "success"
              });
        },
        error: function(error) {
            Swal.fire({
                title: "Error de envio",
                text: "Hubo un error al enviar el correo, por favor intentelo de nuevo mas tarde.",
                icon: "warning"
              });
        }
    });
}
