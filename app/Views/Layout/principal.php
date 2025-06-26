<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotorSpeed</title>
    <link rel="stylesheet" href="<?= base_url('css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/estilo.css') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        /* Estilos personalizados para el menú desplegable de Hola, Usuario*/
        /*Lo coloque aquí porque no me toma en mi hoja de estilo externa*/ 
        .custom-dropdown {
            background-color: #6e6e6e;
            border: 1px solid #baff39;
            padding: 0;
            margin: 0;
            list-style: none;
        }
        .custom-dropdown li {
            margin: 0;
            padding: 0;
        }
        .custom-dropdown .dropdown-divider {
            margin: 0;
            border-color: #555;
        }
        .custom-dropdown-item {
            padding: 8px 16px ;
            display: flex ;
            align-items: center ;
            font-size: 14px ;
            line-height: 1.4 ;
            transition: all 0.15s ease-in-out ;
            white-space: nowrap ;
            border: none ;
            color: #fff ;
            width: 100% ;
            margin: 0 ;
            border-radius: 0 ;
            box-sizing: border-box ;
            text-decoration: none ;
        }
        .custom-dropdown-item:hover,
        .custom-dropdown-item:focus {
            background-color: #baff39 ;
            box-shadow: cornsilk 0px 0px 15px ;
            color: #000 ;
            width: 100% ;
            margin: 0 ;
            text-decoration: none ;
        }
        .custom-dropdown-item.text-danger {
            color: #fff ;
        }
        .custom-dropdown-item.text-danger:hover,
        .custom-dropdown-item.text-danger:focus {
            background-color: #baff39 ;
            box-shadow: cornsilk 0px 0px 15px ;
            color: #000 ;
            width: 100% ;
            margin: 0 ;
        }
        .custom-dropdown-item i {
            width: 16px ;
            height: 16px ;
            display: inline-flex ;
            align-items: center ;
            justify-content: center ;
            margin-right: 8px ;
            flex-shrink: 0 ;
        }
        /* Estilos para pantallas pequeñas */
        @media (max-width: 991.98px) {
            .custom-dropdown {
                position: absolute ;
                top: 100% ;
                left: 50% ;
                transform: translateX(-50%) ;
                width: 250px ;
                min-width: 250px ;
                max-width: 250px ;
                margin: 0 ;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15) ;
                border-radius: 0.375rem ;
                background-color: #6e6e6e ;
                border: 1px solid #baff39 ;
                z-index: 1000 ;
                margin-top: 0.125rem ;
            }
            .custom-dropdown-item {
                width: 100% ;
                box-sizing: border-box ;
                text-align: left ;
                padding: 12px 18px ;
                margin: 0 ;
                border-radius: 0 ;
            }
            .custom-dropdown-item:hover,
            .custom-dropdown-item:focus {
                background-color: #baff39 ;
                box-shadow: cornsilk 0px 0px 15px ;
                color: #000 ;
                width: 100% ;
                padding-left: 18px ;
                padding-right: 18px ;
            }
            /* Evitar que el menú afecte otros elementos */
            .navbar-nav {
                overflow: visible ;
            }
            .dropdown {
                position: relative ;
            }
        }

        /* Estilos para pantallas grandes */
        @media (min-width: 992px) {
            .custom-dropdown {
                position: absolute ;
                top: 100% ;
                right: 0 ;
                left: auto ;
                min-width: 220px ;
                max-width: 280px ;
                padding: 0 ;
                margin: 0 ;
                background-color: #6e6e6e ;
                border: 1px solid #baff39 ;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15) ;
                border-radius: 0.375rem ;
                z-index: 1000 ;
                margin-top: 0.125rem ;
            }
            .custom-dropdown li {
                width: 100% ;
                margin: 0 ;
                padding: 0 ;
            }
            .custom-dropdown-item {
                padding: 12px 0 ;
                margin: 0 ;
                font-size: 14px;
                width: 100%;
                box-sizing: border-box;
                border-radius: 0;
                padding-left: 18px;
                padding-right: 18px;
            }
            .custom-dropdown-item:hover,
            .custom-dropdown-item:focus {
                width: 100%;
                background-color: #baff39;
                box-shadow: cornsilk 0px 0px 15px;
                color: #000;
                margin: 0;
                padding-left: 18px;
                padding-right: 18px;
            }
            .custom-dropdown-item i {
                width: 16px;
                height: 16px;
                margin-right: 10px;
            }
            /* Asegurar que el dropdown esté bien posicionado */
            .dropdown {
                position: relative;
            }
        }
        /* Evitar deformación del buscador */
        .d-flex[role="search"] {
            align-items: flex-start;
        }
        .d-flex[role="search"] .form-control {
            flex-shrink: 1;
            min-width: 0;
        }
        .d-flex[role="search"] .btn {
            flex-shrink: 0;
        }
        .d-flex[role="search"] .dropdown {
            flex-shrink: 0;
        }
        @media (max-width: 991.98px) {
            .d-flex[role="search"] {
                flex-direction: column;
                width: 100%;
                align-items: stretch;
            }
            .d-flex[role="search"] .form-control {
                width: auto;
                flex: 1;
            }
            .d-flex[role="search"] .dropdown .btn {
                width: 100%;
            }
        }
        @media (min-width: 992px) {
            .d-flex[role="search"] {
                flex-direction: row;
                align-items: center;
            }
        }
    </style>
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
                    </li>
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
                <form class="d-flex flex-column flex-lg-row" role="search">
                    <div class="d-flex">
                        <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" disabled/>
                        <button class="btn btn-outline-light" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25"      fill="currentColor" class="bi bi-search" viewBox="0 0 15 15">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg></button>
                    </div>

                    <?php if (session()->get('logged_in')): ?>
                        <div class="dropdown mt-2 mt-lg-0 ms-lg-2 d-flex justify-content-center justify-content-lg-end align-self-center">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuUser" data-bs-toggle="dropdown" aria-expanded="false">
                                ¡Hola, <?= esc(session()->get('nombre') ?: 'Usuario') ?>!
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end custom-dropdown" aria-labelledby="dropdownMenuUser">
                                <li><a class="dropdown-item custom-dropdown-item" href="<?= base_url('modificar-usuario') ?>">
                                    <i class="bi bi-person-gear me-2"></i>Modificar usuario
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item custom-dropdown-item text-danger" href="<?= base_url('eliminar-cuenta') ?>">
                                    <i class="bi bi-person-x me-2"></i>Eliminar cuenta
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item custom-dropdown-item" href="<?= base_url('cerrarSesion') ?>">
                                    <i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión
                                </a></li>
                            </ul>
                        </div>
                    <?php endif; ?>

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
 <!--SwwetAlert2 CDN -->
 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     <?php if (session('mensaje_usuario')): ?>
        <script>
            Swal.fire({
                icon: 'success',
                title: '<?= esc(session('mensaje_usuario')) ?>',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
        <?php endif; ?>

        <?php if (session('error_usuario')): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: '<?= esc(session('error_usuario')) ?>',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
        <?php endif; ?>

        <?php if (session('error')): ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: '<?= esc(session('error')) ?>',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
        <?php endif; ?>
</body>
</html>