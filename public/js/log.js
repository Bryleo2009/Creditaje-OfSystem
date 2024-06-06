function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

function logMessage(level, message, context = {}) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/log", true);
    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    xhr.setRequestHeader("X-CSRF-TOKEN", getCsrfToken());

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            //console.log('Log enviado con éxito:', JSON.parse(xhr.responseText));
        } else if (xhr.readyState === 4) {
            console.error('Error enviando el log:', xhr.responseText);
        }
    };

    var data = JSON.stringify({
        level: level,
        message: message,
        context: context
    });

    xhr.send(data);
}
