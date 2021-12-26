<div class="row justify-content-between align-items-center">
	<div class="col-md-12">
		<h4 class="title">Dashboard
    <small class="float-right h6">Hai, <?= $this->session->userdata('nama');?></small>
    </h4>
	</div>
</div>
<hr>
<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h5>Total Kategori</h5>
        <h3><?= $count_kategori;?> <small>kategori</small></h3>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card">
      <div class="card-body">
        <h5>Total Produk</h5>
        <h3><?= $count_produk;?> <small>produk</small></h3>
      </div>
    </div>
  </div>
</div>