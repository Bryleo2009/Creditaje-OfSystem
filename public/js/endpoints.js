const csrfToken = getCsrfToken();


async function nuevoContacto(nombre, email, servicio) {
    //manda solicitud axaj a la url /api/frm_contacto
    const response = await fetch('/api/contacto', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ nombre: nombre, email: email, servicio: servicio })
    });

    const result = await response.json();
    
    if (result.status === 'success') {
        logMessage('info',`Nuevo contacto creado correctamente ${nombre}[${email}]`);
        return result.message;
    }
    else {
        logMessage('error',`Error al crear nuevo contacto: ${result.message}`);
    }
}

async function actualizarEstadoCorreo(idCliente, nuevoEstado) {
    const response = await fetch(`/api/contacto/${idCliente}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ estado_correo: nuevoEstado })
    });

    const result = await response.json();
    if (result.status === 'success') {
        logMessage('info',`Estado del correo del ID-${idCliente} actualizado correctamente`);
    } else {
        logMessage('error',`Error al actualizar estado del correo del ID-${idCliente}: ${result.message}`);
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
    console.log("desde cliente",id);
    //enviar a listar_cliente.php por metodo get
    const response = await fetch('/api/listar_cliente.php?rpktc=' + id, {
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

//listar tickets
async function listarTickets(id) {
    console.log("desde ticket",id);
    const response = await fetch('/api/listar_ticket.php?rpktc=' + id, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    });

    const result = await response.json();
    if (result.status === 'success') {
        return result;
    } else {
        registrarLog(`Error al listar tickets: ${result.message}`);
    }
}