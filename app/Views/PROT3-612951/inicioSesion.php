<?= $this->extend('Layout/principal');?>
<?= $this->section('content'); ?>

<div class="d-flex justify-content-center align-items-center pt-5" style="color: beige;">
    <div class="text-center pt-5">
        <h1>BIENVENIDO<?= session()->get('nombre') ? ', ' . esc(session()->get('nombre')) : '' ?>!</h1>
        <p>Página en construcción.</p>
        
        <div class="mt-4">
            <?php if (session()->get('logged_in')): ?>
                <div class="card" style="background-color: rgba(255,255,255,0.1); color: white;">
                    <div class="card-body">
                        <h5 class="card-title">Información del usuario:</h5>
                        <p><strong>Nombre:</strong> <?= esc(session()->get('nombre')) ?> <?= esc(session()->get('apellido')) ?></p>
                        <p><strong>Email:</strong> <?= esc(session()->get('email')) ?></p>
                        <p><strong>Teléfono:</strong> <?= esc(session()->get('telefono')) ?></p>
                        <p><strong>Rol:</strong> <?= session()->get('admin') ? 'Administrador' : 'Usuario' ?></p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="mt-4">
            <a href="<?= base_url('cerrarSesion') ?>" class="btn btn-danger">Cerrar sesión</a>
        </div>
    </div>
</div>

<?= $this->endSection();?>