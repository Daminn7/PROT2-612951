<?= $this->extend('Layout/principal');?>
<?= $this->section('content'); ?>


<div id="mi-carousel" class="carousel slide mi-carousel" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#mi-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#mi-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#mi-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<?= base_url('img/3c.gif') ?>" class="" alt="Slide 1">
    </div>
    <div class="carousel-item">
      <img src="<?= base_url('img/2c.gif') ?>" class="" alt="Slide 2">
    </div>
    <div class="carousel-item">
      <img src="<?= base_url('img/1c.gif') ?>" class="" alt="Slide 3">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#mi-carousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#mi-carousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="container cards">
  <div class="row g-3">
    <div class="col-md-6 col-lg-3">
      <div class="card">
        <img src="<?= base_url('img/hatchback.png') ?>" class="card-img-top" alt="Hatchback">
        <div class="card-body">
          <h5 class="card-title">Hatchback</h5>
          <p class="card-text">Los autos hatchback destacan por su diseño compacto, versatilidad y eficiencia. Son ideales para la ciudad, ya que combinan maniobrabilidad, bajo consumo de combustible y un estilo moderno.</p>
        </div>
        <div class="card-footer">
      
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="card">
        <img src="<?= base_url('img/sedan.png') ?>" class="card-img-top" alt="sedan">
        <div class="card-body">
          <h5 class="card-title">Sedán</h5>
          <p class="card-text">Si estás considerando comprar un vehículo y tus necesidades incluyen comodidad, eficiencia y un buen desempeño en ciudad y ruta, un sedán puede ser una excelente elección.</p>
        </div>
        <div class="card-footer">
      
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="card">
        <img src="<?= base_url('img/toyotaSuv.png') ?>" class="card-img-top" alt="suv">
        <div class="card-body">
          <h5 class="card-title">SUV</h5>
          <p class="card-text">Los SUV combinan espacio, potencia y seguridad en un solo vehículo. Ideales para familias, viajes largos o caminos difíciles, los SUV son una excelente opción para quienes buscan versatilidad, robustez y estilo en cada trayecto.</p>
        </div>
        <div class="card-footer">
      
        </div>
      </div>
    </div>

    <div class="col-md-6 col-lg-3">
      <div class="card">
        <img src="<?= base_url('img/pickup.png') ?>" class="card-img-top" alt="pickup">
        <div class="card-body">
          <h5 class="card-title">PickUp</h5>
          <p class="card-text">Las pickups destacan por su fuerza, resistencia y capacidad de carga. Diseñadas para el trabajo pesado y terrenos exigentes, ofrecen una excelente combinación entre rendimiento y durabilidad.</p>
        </div>
        <div class="card-footer">
        </div> 
      </div>
    </div>
  </div>
</div>
<?= $this->endSection();?>