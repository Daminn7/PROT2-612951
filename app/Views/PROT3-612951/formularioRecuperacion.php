<?= $this->extend('layout/principal');?>

<?= $this->section('content');?>


    <div class="caja-formulario shadow-lg form-signin  p-4">
    
        <h1 class="text-center mt-mb-1 fs-4 fw-bold">Has olvidado tu contraseña</h1>

        <form method="POST" action="<?= base_url('password_email'); ?>" autocomplete="off" >

            <?= csrf_field(); ?>
            <div class="mt-2">
                <label class="mb-1" for="email">Correo Electrónico</label>
                <input type="text" class="form-control" name="email" id="email" value="<?= set_value('email')?>" required autofocus>
            </div>

            <div class="d-flex align-items-center">
                <button type="submit" class="mt-2 btn btn-outline-primary">
                Enviar enlace
            </button>
            </div>
        </form>
        
        <?php if ($errors = session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger my-3" role="alert">
                <ul class="mb-0">
                     <?php foreach ($errors as $error): ?>
                <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="iniciar-seccion py-1 border-0 mb-0">
            <div class="text-center">
            <a href="<?= base_url('login');?>">Iniciar sesion</a>
            </div>
        </div>
    
    </div>


<?= $this->endSection();?>