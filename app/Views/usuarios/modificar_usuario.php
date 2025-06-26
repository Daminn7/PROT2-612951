<?= $this->extend('Layout/principal');?>
<?= $this->section('content'); ?>

<style>
    .modificar-usuario-card {
        min-height: 400px;
        max-width: none;
    }
    
    .modificar-usuario-card .card-body {
        background: #000000 ;
        color: #fff ;
    }
    
    .modificar-usuario-card .form-label {
        color: #fff ;
        font-weight: 500;
    }
    
    .modificar-usuario-card .form-control {
        background-color: #333 ;
        border: 1px solid #555 ;
        color: #fff ;
    }
    
    .modificar-usuario-card .form-control:focus {
        background-color: #444 ;
        border-color: #baff39 ;
        box-shadow: 0 0 0 0.2rem rgba(186, 255, 57, 0.25) ;
        color: #fff ;
    }
    
    .modificar-usuario-card .form-control::placeholder {
        color: #ccc ;
    }
    
    .modificar-usuario-card .card-header {
        background-color: #333 ;
        color: #fff ;
        border-bottom: 1px solid #555 ;
    }
    
    .modificar-usuario-card .btn-primary {
        background-color: #baff39 ;
        border-color: #baff39 ;
        color: #000 ;
        font-weight: bold;
    }
    
    .modificar-usuario-card .btn-primary:hover {
        background-color: #a8e632 ;
        border-color: #a8e632 ;
        color: #000 ;
    }
    
    .modificar-usuario-card .btn-secondary {
        background-color: #666 ;
        border-color: #666 ;
        color: #fff ;
    }
    
    .modificar-usuario-card .btn-secondary:hover {
        background-color: #555 ;
        border-color: #555 ;
        color: #fff ;
    }
    
    .modificar-usuario-card .text-muted {
        color: #ccc ;
    }
    
    .modificar-usuario-card h5 {
        color: #fff ;
    }
    
    .modificar-usuario-card hr {
        border-color: #555 ;
    }

    /* Hacer más ancho en pantallas grandes */
    @media (min-width: 768px) {
        .modificar-usuario-card .card-body {
            padding: 3rem 4rem ;
        }
    }
    
    @media (min-width: 992px) {
        .modificar-usuario-card .card-body {
            padding: 3rem 5rem ;
        }
    }
</style>

<div class="container-fluid mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-11 col-md-10 col-lg-9 col-xl-8">
            <div class="card shadow-lg modificar-usuario-card">
                <div class="card-header">
                    <h3 class="text-center">
                        <i class="bi bi-person-gear me-2"></i>Modificar Datos del Usuario
                    </h3>
                </div>
                <div class="card-body p-5">
                    <form method="POST" action="<?= base_url('actualizar-usuario') ?>" autocomplete="off">
                        <?= csrf_field(); ?>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" 
                                       value="<?= old('nombre', $usuario['nombre']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" name="apellido" id="apellido" 
                                       value="<?= old('apellido', $usuario['apellido']) ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" name="email" id="email" 
                                   value="<?= old('email', $usuario['email']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" name="telefono" id="telefono" 
                                   value="<?= old('telefono', $usuario['telefono']) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="direccion" class="form-label">Dirección</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" 
                                   value="<?= old('direccion', $usuario['direccion']) ?>" required>
                        </div>

                        <hr class="my-4">
                        <h5>Cambiar Contraseña (Opcional)</h5>
                        <small class="text-muted">Deja estos campos vacíos si no deseas cambiar la contraseña.</small>

                        <div class="row mt-3">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Nueva Contraseña</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="repassword" class="form-label">Confirmar Nueva Contraseña</label>
                                <input type="password" class="form-control" name="repassword" id="repassword">
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="<?= base_url('PROT3-612951/inicioSesion') ?>" class="btn btn-secondary me-md-2">
                                <i class="bi bi-arrow-left me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-check-circle me-2"></i>Actualizar Datos
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($errors = session()->getFlashdata('errors')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Errores de validación',
            html: '<?php foreach ($errors as $error): ?><?= esc($error) ?><br><?php endforeach; ?>',
            showConfirmButton: true
        });
    </script>
<?php endif; ?>

<?= $this->endSection();?>
