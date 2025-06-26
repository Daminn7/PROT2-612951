<?= $this->extend('Layout/principal');?>
<?= $this->section('content'); ?>

<div class="login">
        <h2 class="text-center pt-4 pb-1">👋Bienvenido a MotorSpeed👋</h2>
        <!--Login-->
        <form method="POST" action="<?= base_url('auth')?>" class="pt-2" autocomplete="off">

        <?= csrf_field(); ?>    

            <div class="mb-4">
                <label for="email" class="form-label">Usuario o Correo electrónico</label>
                <input type="text" class="form-control" name="email" value="<?= old('email') ?>" placeholder="Ingresa tu usuario o email">
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="d-grid justify-content-center">
                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
            </div>

            <div class="my-3 d-grid justify-content-center text-center ">
                <span class="pb-2">¿No tienes cuenta? <a href="<?php echo base_url(); ?> registrarse">Regístrate</a></span>
                <span class="pb-2"><a href="<?echo base_url('password_request')?>"><button class="btn btn-link">Recuperar contraseña</button></a></span>
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