<?= $this->extend('Layout/principal');?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row g-3 tarjetas">
    <div class="col-md-6 col-lg-3">
      <div class="card">
        <img src="<?= base_url('img/padre.png') ?>" class="card-img-top" alt="padre">
        <div class="card-body">
          <h5 class="card-title">Fernando Ríos</h5>
          <p class="card-text">Dueño y Fundador</p>
        </div>
        <div class="card-footer"></div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="card">
        <img src="<?= base_url('img/madre.png') ?>" class="card-img-top" alt="madre">
        <div class="card-body">
          <h5 class="card-title">Elizabeth Cortés</h5>
          <p class="card-text">Dueña y CEO</p>
        </div>
        <div class="card-footer">
      
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="card">
        <img src="<?= base_url('img/hija.png') ?>" class="card-img-top" alt="hija">
        <div class="card-body">
          <h5 class="card-title">Sofía Ríos Cortés</h5>
          <p class="card-text">Accionista minoritaria</p>
        </div>
        <div class="card-footer">
      
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="card">
        <img src="<?= base_url('img/mascota.jpg') ?>" class="card-img-top" alt="mascota">
        <div class="card-body">
          <h5 class="card-title">Tango</h5>
          <p class="card-text">Dueño de las quincenas e inspiración</p>
        </div>
        <div class="card-footer">
        </div> 
      </div>
    </div>
  </div>
    

    <div class="descripcion">
        <p>Esta iniciativa familiar nace de la pasión por los autos y el deseo de ofrecer un servicio excepcional a nuestros clientes. Con años de experiencia en el sector automotriz, nos comprometemos a brindar vehículos de calidad y un trato personalizado.</p>
        <p>En nuestro concesionario, cada miembro de la familia aporta su experiencia y dedicación para garantizar que encuentres el auto perfecto para ti. Desde la selección de vehículos hasta el servicio postventa, estamos aquí para hacer de tu experiencia algo inolvidable.</p>


<?= $this->endSection();?>
