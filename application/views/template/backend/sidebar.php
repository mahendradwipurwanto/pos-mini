<div class="container-fluid">
  <div class="row">
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link <?= ($this->uri->segment(1) == "dashboard" ? "active" : "") ?>" href="<?= site_url('dashboard');?>">
              <span data-feather="home"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?= ($this->uri->segment(1) == "kategori" ? "active" : "") ?>" href="<?= site_url('kategori');?>">
              <span data-feather="file"></span>
              Data Kategori
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Produk</span>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link <?= ($this->uri->segment(1) == "produk" || $this->uri->segment(1) == "tambah-produk" || $this->uri->segment(1) == "edit-produk" ? "active" : "") ?>" href="<?= site_url('produk');?>">
              <span data-feather="file-text"></span>
              Data Produk
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">