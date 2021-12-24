<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="<?= base_url();?>">Majoo Teknologi Indonesia</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
    aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link <?= (empty($this->uri->segment(1)) ? "active" : "") ?>"
          href="<?= base_url();?>">Beranda</a>
      </li>
    </ul>
    <div class="my-2 my-lg-0">
      <a class="btn btn-outline-success my-2 my-sm-0" href="<?= site_url('masuk');?>">Masuk</a>
    </div>
  </div>
</nav>
