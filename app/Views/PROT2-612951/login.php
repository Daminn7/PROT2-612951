<?= $this->extend('Layout/principal');?>
<?= $this->section('content'); ?>

<div class="login">
        <h2 class="text-center pt-4 pb-1">👋Bienvenido a MotorSpeed👋</h2>
        <!--Login-->
        <form action="#" class="pt-2">
            <div class="mb-4">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password">
            </div>
            <div class="mb-4 form-check">
                <input type="checkbox" name="connected" class="form-check-input">
                <label for="connected" class="form-check-label">Mantenerme conectado</label>
            </div>
            <div class="d-grid justify-content-center">
            <button type="button" class="btn btn-primary disabled">Iniciar Sesión</button>
                <!-- DESHABILITACION <a href="<?php echo base_url(); ?>/construccion"><button type="button" class="btn btn-primary disabled">Iniciar Sesión</button></a>-->
            </div>

            <div class="my-3 d-grid justify-content-center text-center ">
                <span>¿No tienes cuenta? <button class="btn btn-link disabled"> Regístrate </button></span>
                <span class="pb-2"><button class="btn btn-link disabled">Recuperar contraseña</button></span>

                <!-- DESHABILITACION
                <span class="pb-2">¿No tienes cuenta? <a href="<?php echo base_url(); ?>/">Regístrate</a></span>
                <span class="pb-2"><a href="<?php echo base_url(); ?>/">Recuperar contraseña</a></span>
                -->
            </div>

            <!--<div class="d-grip">
                <button type="button" class="btn btn-primary"></button>
            </div>-->
        </form>
   </div>


<?= $this->endSection();?>