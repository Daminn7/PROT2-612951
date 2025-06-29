<?= $this->extend('Layout/principal');?>
<?= $this->section('content'); ?>

    <div class="caja-formulario shadow-lg form-signin">
    
        <h1 class="text-center fs-4 fw-bold mt-3">Registro</h1>

        <?= helper('form'); ?>
        <form class="form" method="POST" action="<?= base_url('crearCuenta');?>" autocomplete="off" >
        <!--<fieldset disabled>-->
            <?= csrf_field(); ?>
            <div class="mb-1">
                <label class="mb-1" for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="<?= set_value('nombre')?>" required autofocus>
            </div>

            <div class="mb-1">
                <label class="mb-1" for="apellido">Apellido</label>
                <input type="text" class="form-control" name="apellido" id="apellido" value="" required autofocus>
            </div>

            <div class="mb-1">
                <label class="mb-1" for="domicilio">Domicilio</label>
                <input type="text" class="form-control" name="domicilio" id="domicilio" value="" required autofocus>
            </div>

            <div class="mb-1">
                <label class="mb-1" for="telefono">Teléfono</label>
                <input type="text" class="form-control" name="telefono" id="telefono" value="" required autofocus>
            </div>

            <div class="mt-2">
                <label class="mb-1" for="email">Correo electrónico</label>
                <input type="text" class="form-control" name="email" id="email" value="" required autofocus>
            </div>

            <div class="mb-1">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" name="password" id="password" value="" required autofocus>
            </div>

            <div class="mb-1">
                <label for="repassword">Confirmar contraseña</label>
                <input type="password" class="form-control" name="repassword" id="repassword" value="" required autofocus>
            </div>
            </fieldset>
            <button type="submit" class="registrar mt-2 btn btn-outline-primary">
                Registrar
            </button>
        </form>

        <div class="iniciar-seccion py-2 border-0">
            <div class="text-center">
                <a href="<?= base_url('login')?>"><button class="btn btn-outline-primary">Iniciar sesion</button></a>
            </div>
        </div>
    
    </div>

    <?php if (session('errors')): ?>
    <div class="alert alert-danger">
        <?php foreach(session('errors') as $error): ?>
            <div><?= esc($error) ?></div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

<?= $this->endSection();?>
