<?= $this->extend('Layout/principal');?>

<?= $this->section('content');?>

<div class="login">
    <h2 class="text-center pt-4 pb-1">🔐 Recuperar Contraseña 🔐</h2>
    <p class="text-center mb-4" style="color: #ccc;">Ingresa tu correo electrónico y te enviaremos un enlace para restablecer tu contraseña</p>
    
    <!--Formulario Recuperación-->
    <form method="POST" action="<?= base_url('password_email'); ?>" class="pt-2" autocomplete="off">
        <?= csrf_field(); ?>
        
        <div class="mb-4">
            <label class="form-label" for="email">Correo Electrónico</label>
            <input type="email" class="form-control" name="email" id="email" 
                   value="<?= old('email')?>" 
                   placeholder="Ingresa tu correo electrónico" 
                   required autofocus>
        </div>

        <div class="d-grid justify-content-center">
            <button type="submit" class="btn btn-primary">
                Enviar Enlace de Recuperación
            </button>
        </div>

        <div class="my-3 d-grid justify-content-center text-center">
            <span class="pb-2">
                <a href="<?= base_url('login');?>" class="btn btn-link">
                    ← Volver al Inicio de Sesión
                </a>
            </span>
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

    <?php if ($mensaje = session()->getFlashdata('mensaje_usuario')): ?>
        <div class="alert alert-success my-3" role="alert">
            <?= esc($mensaje) ?>
        </div>
    <?php endif; ?>

    <?php if ($error = session()->getFlashdata('error_usuario')): ?>
        <div class="alert alert-danger my-3" role="alert">
            <?= esc($error) ?>
        </div>
    <?php endif; ?>

</div>

<?= $this->endSection();?>