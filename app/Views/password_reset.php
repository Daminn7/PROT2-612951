<?= $this->extend('Layout/principal');?>

<?= $this->section('content');?>

<div class="login">
    <h2 class="text-center pt-4 pb-1">🔐 Restablecer Contraseña 🔐</h2>
    <p class="text-center mb-4" style="color: #ccc;">Ingresa tu nueva contraseña para completar el proceso de recuperación</p>
    
    <!--Formulario Reseteo Contraseña-->
    <form method="POST" action="<?= base_url('password_reset') ?>" class="pt-2" autocomplete="off">
        <?= csrf_field() ?>
        <input type="hidden" name="token" value="<?= $token ?>">
        
        <div class="mb-4">
            <label for="password" class="form-label">Nueva Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" 
                   minlength="6" placeholder="Ingresa tu nueva contraseña" required>
            <div class="form-text" style="color: #999;">Mínimo 6 caracteres</div>
        </div>

        <div class="mb-4">
            <label for="repassword" class="form-label">Confirmar Nueva Contraseña</label>
            <input type="password" class="form-control" id="repassword" name="repassword" 
                   minlength="6" placeholder="Confirma tu nueva contraseña" required>
        </div>

        <div class="d-grid justify-content-center">
            <button type="submit" class="btn btn-primary">
                Restablecer Contraseña
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

    <?php if (isset($errors) && $errors): ?>
        <div class="alert alert-danger my-3" role="alert">
            <ul class="mb-0">
                 <?php foreach ($errors as $error): ?>
            <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if (session()->get('mensaje_usuario')): ?>
        <div class="alert alert-success my-3" role="alert">
            <?= esc(session()->get('mensaje_usuario')) ?>
        </div>
    <?php endif; ?>

    <?php if (session()->get('error_usuario')): ?>
        <div class="alert alert-danger my-3" role="alert">
            <?= esc(session()->get('error_usuario')) ?>
        </div>
    <?php endif; ?>

</div>

<?= $this->endSection();?>
