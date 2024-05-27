
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
