<?php
session_start(); // Iniciar la sesión

// Verificar si la sesión está activa
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirigir a la página de inicio de sesión o mostrar un mensaje de error
    header("Location: ../admin-back.php"); // Reemplaza "login.php" con la ruta de tu página de inicio de sesión
    exit; // Detener la ejecución del código restante
}

// Eliminar el archivo si se ha enviado una solicitud de eliminación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logfile'])) {
    $logFile = '../logs/' . basename($_POST['logfile']);
    if (file_exists($logFile) && unlink($logFile)) {
        echo 'success';
    } else {
        echo 'failure';
    }
    exit;
}

// Obtener la lista de archivos de log
$logFiles = glob('../logs/*.log');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log Files</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e3a4a2320e.js" crossorigin="anonymous"></script>
    <style>
        #logContent {
            height: 100vh;
            background-color: #f8f9fa;
            border-left: 1px solid #dee2e6;
            overflow-y: auto;
            padding: 20px;
        }
        .close-btn {
            cursor: pointer;
        }
        .log-container {
            display: flex;
        }
        .log-table {
            width: 20%;
            margin-right: 25px;
        }
        .log-content {
            width: 80%;
            display: none;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid mt-5 log-container">
    <!-- Botón de cerrar sesión -->
    <div class="log-table">
        <div style="display: flex; margin-bottom: 25px;">
            <a href="../api/logout.php" class="btn btn-danger">Cerrar Sesión</a>
        </div>
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Log File</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($logFiles as $logFile): ?>
                <tr>
                    <td>
                        <a href="#" class="log-link" data-logfile="<?php echo basename($logFile); ?>">
                            <?php echo basename($logFile); ?>
                        </a>
                    </td>
                    <td>
                        <button class="btn btn-danger delete-log" data-logfile="<?php echo basename($logFile); ?>"><i class="fa-solid fa-trash"></i></button>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div id="logContent" class="log-content">
        <span class="close-btn float-right" aria-label="Close">&times;</span>
        <h4 id="logFileName" class="mt-3"></h4>
        <pre id="logFileContent"></pre>
    </div>
</div>

<script>
    function showLogContent(logFile) {
        var logFileNameElement = document.getElementById("logFileName");
        var logFileContentElement = document.getElementById("logFileContent");
        var logContentElement = document.getElementById("logContent");

        logFileNameElement.textContent = logFile;
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "/logs/" + logFile, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                logFileContentElement.textContent = xhr.responseText;
                logContentElement.style.display = 'block';
            }
        };
        xhr.send();
    }

    function deleteLogFile(logFile, rowElement) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "", true);  // Enviar la solicitud POST a la misma URL
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                if (xhr.responseText === "success") {
                    rowElement.remove();
                } else {
                    alert("Failed to delete log file.");
                }
            }
        };
        xhr.send("logfile=" + encodeURIComponent(logFile));
    }

    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll(".log-link").forEach(function (element) {
            element.addEventListener("click", function (event) {
                event.preventDefault();
                var logFile = this.getAttribute("data-logfile");
                showLogContent(logFile);
            });
        });

        document.querySelectorAll(".delete-log").forEach(function (element) {
            element.addEventListener("click", function () {
                var logFile = this.getAttribute("data-logfile");
                var rowElement = this.closest("tr");
                if (confirm("Are you sure you want to delete this log file?")) {
                    deleteLogFile(logFile, rowElement);
                }
            });
        });

        document.querySelector("#logContent .close-btn").addEventListener("click", function () {
            document.getElementById("logContent").style.display = 'none';
        });
    });
</script>
</body>
</html>
