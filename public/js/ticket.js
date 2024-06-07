$(document).ready(function() {
    $('#archivo').on('change', function() {
      var archivos = $(this)[0].files;
      var archivosGuardados = JSON.parse(localStorage.getItem('archivos')) || [];

      for (var i = 0; i < archivos.length; i++) {
        var archivo = archivos[i];
        var archivoInfo = { name: archivo.name, type: archivo.type };
        var archivoExistente = archivosGuardados.find(function(a) {
          return a.name === archivo.name && a.type === archivo.type;
        });
        if(archivosGuardados.length < 4){
            if (!archivoExistente) {
            archivosGuardados.push(archivoInfo);
            }
        }else{
            alert("Solo se pueden adjuntar mpaximo 4 archivos");
        }
      }

      localStorage.setItem('archivos', JSON.stringify(archivosGuardados));
      mostrarArchivosGuardados();
    });

    function mostrarArchivosGuardados() {
      var archivosGuardados = JSON.parse(localStorage.getItem('archivos')) || [];
      $('#archivos-adjuntos').empty();

      archivosGuardados.forEach(function(archivo, index) {
        var archivoAdjunto = $('<div class="alert alert-secondary" role="alert">' + archivo.name + ' <button type="button" class="close" data-index="' + index + '"><span aria-hidden="true">&times;</span></button></div>');
        $('#archivos-adjuntos').append(archivoAdjunto);
      });
    }

    $('#archivos-adjuntos').on('click', '.close', function() {
      var index = $(this).data('index');
      var archivosGuardados = JSON.parse(localStorage.getItem('archivos')) || [];
      archivosGuardados.splice(index, 1);
      localStorage.setItem('archivos', JSON.stringify(archivosGuardados));
      mostrarArchivosGuardados();
    });

    // Mostrar los archivos guardados al cargar la página
    mostrarArchivosGuardados();



    $('.eliminar-ticket').click(function(event) {
      event.preventDefault(); // Prevenir la acción predeterminada del enlace      
      var ticketId = $(this).data('ticket-id'); // Obtener el ID del ticket desde el atributo data

      Swal.fire({
        title: '¿Estás seguro?',
        text: "Al eliminar este ticket no se podrá revertir dicha acción",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí'
      }).then((result) => {
        if (result.isConfirmed) {
          eliminarTicket(ticketId); // Llamar a la función para eliminar el ticket con el ID obtenido
        }
      });
    });



  });

document.getElementById('descripcion').addEventListener('input', function() {
    this.style.height = 'auto'; // Restablece la altura a automática
    this.style.height = (this.scrollHeight) + 'px'; // Ajusta la altura según el contenido
});

document.getElementById("formTicket").addEventListener("submit", function(e) {
  e.preventDefault(); // Evita que el formulario se envíe de manera convencional
	enviarTicket(); // Llama a la función enviarCorreo()
});



function enviarTicket() {
  $("#spinner").show();
  
  //obten de local storage los archivos adjuntos
  var archivosGuardados = JSON.parse(localStorage.getItem('archivos')) || [];
  var cliente_id = document.getElementById("cliente").value;
  var asunto = document.getElementById("asunto").value;
  var descripcion = document.getElementById("descripcion").value;
  var prioridad = document.getElementById("prioridad").value;
  var categoria = document.getElementById("categoria").value;


  fetch('/tck/client/'+cliente_id+'CLT', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken
    },
    body: JSON.stringify({
      cliente_id: cliente_id,
      asunto: asunto,
      descripcion: descripcion,
      prioridad: prioridad,
      categoria: categoria,
    })
  })
  .then(response => response.json())
  .then(data => {

    console.log(data);
    $("#spinner").hide();

    if(data.status == 'success'){
      Swal.fire({
        title: "Registrado",
        text: "Su ticket ha sido registrado exitosamente. Su código de seguimiento es " + data.message ,
        icon: "success"
      }).then((result) => {
        if (result.isConfirmed) {
          //limpiar los campos
          document.getElementById("asunto").value = "";
          document.getElementById("descripcion").value = "";

          //redireccionar a la pagina de tickets
          window.location.href = "/tck/client/" + cliente_id + "CLT";
        }
      });

      
    }else{
      Swal.fire({
        title: "Error",
        text: "Error al crear ticket",
        icon: "error"
      });
      logMessage('error',data.message);
    }
  })
  

}

$('.eliminar-ticket').click(function(event) {
  console.log('Eliminar ticket');
  
});

function eliminarTicket(ticketId) {
  $("#spinner").show();
  $.ajax({
      url: '/tck/' + ticketId, // URL de la ruta para eliminar el ticket
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      type: 'DELETE', // Método HTTP DELETE
      success: function(response) {
          $("#spinner").hide();
          Swal.fire({
            title: "El ticket ha sido eliminado correctamente",
            icon: "success",
            showConfirmButton: false,
            timer: 1500
          });
          window.location.reload();
      },
      error: function(xhr, status, error) {
          logMessage('error', error);
      }
  });
}


