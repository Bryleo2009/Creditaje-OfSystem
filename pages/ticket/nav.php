<header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="/images/logo/texto-logo-v2.png" alt="logo-ofsystem" width="170" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active blanco" id="new" aria-current="page" href="generar.php">Nuevo Ticket</a>
                        <a class="nav-link blanco" id="view" href="propios.php">Mis Tickets</a>
                    </div>
                </div>
            </div>
        </nav>
</header>

<script>
    //obten del localstorage la variable rpktc y mandalos como parametro en los href
    let rpktc = localStorage.getItem('rpktc');
    if (rpktc) {
        document.querySelector('#new').href = `generar.php?rpktc=${rpktc}`;
        document.querySelector('#view').href = `propios.php?rpktc=${rpktc}`;
    }
</script>