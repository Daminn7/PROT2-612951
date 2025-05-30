<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotorSpeed</title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/estilo.css') ?>">

</head>
<body>
    <header class="row-1">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo base_url(); ?>/"><img src="<?= base_url('img/logo.png') ?>" alt="Logo" class="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"  aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>      
                 
                </button>
             <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                     <li class="nav-item">
                         <a class="nav-link active" aria-current="page" href="<?php echo base_url(); ?>/">Principal</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>/quienesSomos">¿Quiénes somos?</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>/acercade">Acerca de</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>/registrarse">Registrarse</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url(); ?>/login">Login</a>
                    <li class="nav-item dropdown">
                        <a class="disabled d-none nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Productos
                        </a>
                            <ul class="disabled d-none dropdown-menu ">
                                <li><a class="dropdown-item" href="#">0km</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Usados</a></li>
                            </ul>
                    </li>
                    
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" disabled/>
                    <button class="btn btn-outline-light" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"      fill="currentColor" class="bi bi-search" viewBox="0 0 15 15">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg></button>
                 </form>
                </div>
            </div>
        </nav>
    </header> 
    <main class="row-1">
        <?= $this->renderSection('content') ?>
    </main>
    <footer class="row-1">
        <div class="container">
            <div>
                <a href="https://www.facebook.com" target="_blank"><img src="<?= base_url('img/facebook.png') ?>" alt="Facebook"></a>
                <a href="https://x.com" target="_blank"><img src="<?= base_url('img/x.png') ?>" alt="X"></a>
                <a href="https://www.instagram.com" target="_blank"><img src="<?= base_url('img/ig.png') ?>" alt="Instagram"></a>
            </div>
            <div>&copy; 2025 MotorSpeed. Todos los derechos reservados.</div>
        </div>
    </footer>
    <script src="<?= base_url('js/bootstrap.bundle.min.js') ?>"></script>
</body>
</html>