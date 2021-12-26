<section class="jumbotron text-center mb-0">
	<div class="container">
		<h1 class="jumbotron-heading mt-5">Produk kami</h1>
		<p class="lead text-muted">Temukan produk terbaik milik kami disini.</p>
		<p>
	</div>
</section>

<div class="album py-5 bg-light">
	<div class="container">

		<div class="row mb-4">

			<?php if($produk == false){?>
			<div class="col-md-12 text-center">belum ada produk</div>
			<?php }else{?>
			<?php foreach ($produk as $key) {?>
			<div class="col-md-3 d-flex align-self-stretch">
				<div class="card mb-4 box-shadow cursor" data-toggle="modal"
					data-target="#detail-produk-<?= $key->id_produk;?>">
					<img class="card-img-top"
						src="<?= base_url();?><?= $key->poster == null ? 'assets/img/placeholder.png' : 'berkas/produk/'.$key->permalink.'/'.$key->poster;?>"
						alt="Card image cap">
					<div class="card-body d-flex flex-column">
						<h5 class="card-title text-center"><?= $key->nama_produk;?></h5>
						<h6 class="text-muted text-center">Rp.<?= number_format($key->harga,0,",",".");?></h6>
						<p class="text-muted"><?= substr(strip_tags($key->keterangan), 0, 100);?></p>
						<div class="mt-auto d-flex justify-content-center align-items-center">
							<a href="<?= site_url('checkout/'.$key->permalink);?>" target="_blank" class="btn btn-sm btn-outline-secondary">beli sekarang</a>
						</div>
					</div>
				</div>
			</div>

			<!-- Modal -->
			<div class="modal fade" id="detail-produk-<?= $key->id_produk;?>" tabindex="-1" role="dialog"
				aria-labelledby="edit-kategori-<?= $key->id_kategori;?>" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle">Detail produk</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<img class="card-img-top"
								src="<?= base_url();?><?= $key->poster == null ? 'assets/img/placeholder.png' : 'berkas/produk/'.$key->permalink.'/'.$key->poster;?>"
								alt="Card image cap">
							<div class="card-body d-flex flex-column">
								<h5 class="card-title text-center"><?= $key->nama_produk;?></h5>
								<h6 class="text-muted text-center">Rp.<?= number_format($key->harga,0,",",".");?> - <span
										class="badge <?php $a = rand(1, 4); if($a == 1){ echo 'badge-primary';}elseif($a == 2){echo 'badge-info'; }elseif($a == 3){echo 'badge-warning';}else{ echo 'badge-secondary'; }?>"><?= $key->kategori;?></span>
								</h6>
								<p class="text-muted"><?= substr(strip_tags($key->keterangan), 0, 100);?></p>
							</div>
							<div class="modal-footer">
								<a href="<?= site_url('checkout/'.$key->permalink);?>" target="_blank" class="btn btn-sm btn-outline-secondary">beli sekarang</a>
								<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php }?>
			<?php }?>
		</div>

	</div>
</div>
