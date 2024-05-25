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
                title: "The Internet?",
                text: "That thing is still around?",
                icon: "question"
              });
        }
    });
}
