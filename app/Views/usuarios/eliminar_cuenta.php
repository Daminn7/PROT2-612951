<?= $this->extend('Layout/principal');?>
<?= $this->section('content'); ?>

<style>
    .eliminar-cuenta-card {
        min-height: 400px;
        max-width: none;
    }
    
    .eliminar-cuenta-card .card-body {
        background: #000000 ;
        color: #fff ;
    }
    
    .eliminar-cuenta-card .card-header {
        background: linear-gradient(135deg, #dc3545, #c82333) ;
        color: #fff ;
        border-bottom: 1px solid #dc3545 ;
    }
    
    .eliminar-cuenta-card .form-label {
        color: #fff ;
        font-weight: 500;
    }
    
    .eliminar-cuenta-card .form-control {
        background-color: #333 ;
        border: 1px solid #555 ;
        color: #fff ;
    }
    
    .eliminar-cuenta-card .form-control:focus {
        background-color: #444 ;
        border-color: #baff39 ;
        box-shadow: 0 0 0 0.2rem rgba(186, 255, 57, 0.25) ;
        color: #fff ;
    }
    
    .eliminar-cuenta-card .form-control::placeholder {
        color: #ccc ;
    }
    
    .eliminar-cuenta-card .alert-danger {
        background-color: #2d1b1b ;
        border-color: #dc3545 ;
        color: #f8d7da ;
    }
    
    .eliminar-cuenta-card .btn-secondary {
        background-color: #666 ;
        border-color: #666 ;
        color: #fff ;
    }
    
    .eliminar-cuenta-card .btn-secondary:hover {
        background-color: #555 ;
        border-color: #555 ;
        color: #fff ;
    }
    
    .btn-eliminar-cuenta {
        background: linear-gradient(45deg, #dc3545, #c82333);
        border: none;
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.3);
        transition: all 0.3s ease;
    }
    
    .btn-eliminar-cuenta:hover {
        background: linear-gradient(45deg, #c82333, #bd2130);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(220, 53, 69, 0.4);
    }
    
    .form-control-lg {
        padding: 15px 20px;
        font-size: 16px;
    }

    /* Hacer más ancho en pantallas grandes */
    @media (min-width: 768px) {
        .eliminar-cuenta-card .card-body {
            padding: 3rem 4rem ;
        }
    }
    
    @media (min-width: 992px) {
        .eliminar-cuenta-card .card-body {
            padding: 3rem 5rem ;
        }
    }
</style>

<div class="container-fluid mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-11 col-md-10 col-lg-9 col-xl-8">
            <div class="card border-danger shadow-lg eliminar-cuenta-card">
                <div class="card-header">
                    <h3 class="text-center mb-0">⚠️ Eliminar Cuenta</h3>
                </div>
                <div class="card-body p-5">
                    <div class="alert alert-danger" role="alert">
                        <strong>¡Atención!</strong> Esta acción desactivará tu cuenta permanentemente. 
                        No podrás acceder al sistema hasta que un administrador reactive tu cuenta.
                    </div>

                    <form method="POST" action="<?= base_url('confirmar-eliminar-cuenta') ?>" autocomplete="off">
                        <?= csrf_field(); ?>

                        <div class="mb-4">
                            <label for="password" class="form-label">
                                <i class="bi bi-key me-2"></i>Confirma tu contraseña actual
                            </label>
                            <input type="password" class="form-control form-control-lg" name="password" id="password" 
                                   placeholder="Ingresa tu contraseña para confirmar" required>
                        </div>

                        <div class="d-grid gap-3">
                            <a href="<?= base_url('PROT3-612951/inicioSesion') ?>" class="btn btn-secondary btn-lg">
                                <i class="bi bi-arrow-left me-2"></i>Cancelar
                            </a>
                            <button type="submit" class="btn btn-danger btn-lg btn-eliminar-cuenta" 
                                    onclick="return confirm('¿Estás completamente seguro de que deseas eliminar tu cuenta? Esta acción desactivará tu cuenta.')">
                                <i class="bi bi-person-x me-2"></i>Eliminar mi cuenta
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="text-center mt-3 mb-4">
                <small class="text-light">
                    Si cambias de opinión, puedes contactar al soporte para reactivar tu cuenta.
                </small>
            </div>
        </div>
    </div>
</div>

<?php if ($errors = session()->getFlashdata('errors')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Error',
            html: '<?php foreach ($errors as $error): ?><?= esc($error) ?><br><?php endforeach; ?>',
            showConfirmButton: true
        });
    </script>
<?php endif; ?>

<?= $this->endSection();?>
