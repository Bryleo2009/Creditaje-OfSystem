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


//coger parametro id de la ruta
const urlParams = new URLSearchParams(window.location.search);
const id = urlParams.get('rpktc');
console.log(id);
listarCliente(id).then(response => {
    if (response.status === 'success') {
        const data = response.data;
        //recorre data y el atributo descripcion y id utilizalos para poblar un select id="cliente"
        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.nombre;
            document.getElementById('cliente').appendChild(option);
        });
    } else {
        registrarLog(error.message);
    }
});


//llama a la funcion async function listarPrioridades() y si la respuesta es success, entonces sus valores jsn usalos para llenar el select
listarPrioridades().then(response => {
    if (response.status === 'success') {
        const data = response.data;
        //recorre data y el atributo descripcion y id utilizalos para poblar un select id="prioridad"
        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.descripcion;
            document.getElementById('prioridad').appendChild(option);
        });
    } else {
        registrarLog(error.message);
    }
});

//llama a la funcion async function listarCategorias() y si la respuesta es success, entonces sus valores jsn usalos para llenar el select
listarCategorias().then(response => {
    if (response.status === 'success') {
        const data = response.data;
        //recorre data y el atributo descripcion y id utilizalos para poblar un select id="categoria"
        data.forEach(item => {
            const option = document.createElement('option');
            option.value = item.id;
            option.textContent = item.descripcion;
            document.getElementById('categoria').appendChild(option);
        });
    } else {
        registrarLog(error.message);
    }
});

document.getElementById('descripcion').addEventListener('input', function() {
    this.style.height = 'auto'; // Restablece la altura a automática
    this.style.height = (this.scrollHeight) + 'px'; // Ajusta la altura según el contenido
});