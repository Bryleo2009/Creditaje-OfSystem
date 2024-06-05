<?php
//coge de la ruta el parametro rpktc y almacenalo en local storage
if (isset($_GET['rpktc'])) {
    $id = $_GET['rpktc'];
    echo "<script>localStorage.setItem('rpktc', '$id');</script>";
}

?>

<!DOCTYPE html>
<html>

<head>
    <!--metadatos-->
    <meta name="description" content="Soluciones web personalizadas para impulsar tu presencia en línea y alcanzar el éxito digital.">
    <?php require_once('../header.php'); ?>
    <link rel="stylesheet" href="/css/ticket.css">
    <!--título-->
    <title>Ticket - Of System</title>
</head>

<body>
    <?php require_once('nav.php'); ?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center mt-3 mb-5">Nuevo Ticket</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="/ticket/generar.php" method="post" class="row justify-content-between">
                        <div class="mb-3 col-5">
                            <label for="cliente" class="form-label">Cliente</label>
                            <select class="form-select w-100" id="cliente" name="cliente" required>
                            </select>
                        </div>
                        <div class="mb-3 col-3">
                        </div>
                        <div class="mb-3 col-2">
                            <label for="prioridad" class="form-label">Prioridad</label>
                            <select class="form-select w-100" id="prioridad" name="prioridad" required>
                            </select>
                        </div>
                        <div class="mb-3 col-2">
                            <label for="categoria" class="form-label">Categoría</label>
                            <select class="form-select w-100" id="categoria" name="categoria" required>
                            </select>
                        </div>
                        <div class="mb-3 col-12">
                            <label for="asunto" class="form-label">Asunto</label>
                            <input type="text" class="form-control" id="asunto" name="asunto" required>
                        </div>
                        <div class="mb-3 col-12">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                        </div>
                        <div class="mb-3 col-12">
                            <label for="archivo" class="form-label">Adjuntar archivo</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="archivo" name="archivo" multiple>
                                <label class="custom-file-label" for="archivo">Seleccionar Archivos</label>
                            </div>
                            <div id="archivos-adjuntos" class="mt-3">
                                <!-- Aquí se mostrarán los archivos adjuntos -->
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>
    <?php require_once '../footer.php'; ?>
</body>

</html>