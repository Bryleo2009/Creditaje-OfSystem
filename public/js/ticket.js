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
  });

document.getElementById('descripcion').addEventListener('input', function() {
    this.style.height = 'auto'; // Restablece la altura a automática
    this.style.height = (this.scrollHeight) + 'px'; // Ajusta la altura según el contenido
});

function enviarTicket() {
  //obten de local storage los archivos adjuntos
  var archivosGuardados = JSON.parse(localStorage.getItem('archivos')) || [];
  var cliente_id = document.getElementById("cliente").value;
  var asunto = document.getElementById("asunto").value;
  var descripcion = document.getElementById("descripcion").value;
  var prioridad = document.getElementById("prioridad").value;
  var categoria = document.getElementById("categoria").value;



}


