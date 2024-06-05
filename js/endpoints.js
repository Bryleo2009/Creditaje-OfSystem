
async function nuevoContacto(nombre, email, servicio) {
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

//crear una para session.php mandale email y password encryp
async function iniciarSesion(email, password) {
    const response = await fetch('/api/session.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: email, password: password })
    });

    const result = await response.json();
    if (result.status === 'success') {
        //registrarLog(`Sesión iniciada correctamente`);
        return result;
    } else {
        //registrarLog(`Error al iniciar sesión: ${result.message}`);
        return result.message;
    }
}

//listar prioridades de ticket
async function listarPrioridades() {
    const response = await fetch('/api/listar_prioridad.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    const result = await response.json();
    if (result.status === 'success') {
        return result;
    } else {
        registrarLog(`Error al listar prioridades de ticket: ${result.message}`);
    }
}


//listar categorias de ticket
async function listarCategorias() {
    const response = await fetch('/api/listar_categoria.php', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    const result = await response.json();
    if (result.status === 'success') {
        return result;
    } else {
        registrarLog(`Error al listar categorias de ticket: ${result.message}`);
    }
}

//listar cliente modifica para que no sea asincrona
async function listarCliente(id) {
    //enviar a listar_cliente.php por metodo get
    const response = await fetch('/api/listar_cliente.php?rpktc=' + id + 'CTL', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    const result = await response.json();
    if (result.status === 'success') {
        return result;
    } else {
        registrarLog(`Error al listar cliente: ${result.message}`);
    }
}