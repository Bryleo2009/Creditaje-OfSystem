function registrarLog(mensaje) {
    const log = `${mensaje}\n`;

    // Enviar el log al servidor para ser guardado en el archivo
    fetch('/api/log.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ log: log })
    })
    .catch(error => console.error('Error al enviar el log:', error));
}
