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
<div class="card-group">
  <div class="card col-md-6">
    <img src="<?= base_url('img/hatchback.png') ?>" class="card-img-top" alt="Hatchback">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    </div>
    <div class="card-footer">
      
    </div>
  </div>
  <div class="card col-md-6">
    <img src="<?= base_url('img/sedan.png') ?>" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
    </div>
    <div class="card-footer">
      
    </div>
  </div>
  <div class="card col-md-6">
    <img src="<?= base_url('img/toyotaSuv.png') ?>" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
    </div>
    <div class="card-footer">
      
    </div>
  </div>
  <div class="card col-md-6">
    <img src="<?= base_url('img/pickup.png') ?>" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">Card title</h5>
      <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
    </div>
    <div class="card-footer">
      
    </div>
  </div>
</div>
</div>
<?= $this->endSection();?>