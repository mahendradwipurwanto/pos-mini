<div class="row justify-content-between align-items-center">
	<div class="col-md-12">
		<h4 class="title">Data Produk
			<a href="<?= site_url('tambah-produk');?>" class="btn btn-primary btn-sm float-right">tambah produk</a>
		</h4>
	</div>
</div>
<hr>

<div class="row mt-2">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive mb-4">
					<table class="table table-hover table-bordered table-nowrap">
						<thead class="thead-light">
							<tr>
								<th>No</th>
								<th></th>
								<th>Produk</th>
								<th>Kategori</th>
								<th>Harga</th>
							</tr>
						</thead>
						<tbody>
							<?php if($produk == false){?>
							<tr>
								<td colspan="5" class="text-center">belum ada data</td>
							</tr>
							<?php }else{?>
							<?php if(empty($this->uri->segment(2)) ? $no = 1 : $no = $this->uri->segment(2)+1); foreach ($produk as $key) {?>
							<tr>
								<th><?= $no++;?></th>
								<td>
									<a href="<?= site_url('edit-produk/'.$key->permalink);?>" class="btn btn-info btn-sm">ubah</a>
									<button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
										data-target="#hapus-produk-<?= $key->id_produk;?>">hapus</button>
								</td>
								<td><?= $key->nama_produk;?></td>
								<td><span
										class="badge <?php $a = rand(1, 4); if($a == 1){ echo 'badge-primary';}elseif($a == 2){echo 'badge-info'; }elseif($a == 3){echo 'badge-warning';}else{ echo 'badge-secondary'; }?>"><?= $key->kategori;?></span>
								</td>
								<td>Rp.<?= number_format($key->harga,0,",",".");?></td>
							</tr>
							<!-- Modal -->
							<div class="modal fade" id="hapus-produk-<?= $key->id_produk;?>" tabindex="-1" role="dialog"
								aria-labelledby="edit-kategori-<?= $key->id_kategori;?>" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered modal-sm" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle">Hapus produk</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="<?= site_url('admin/hapus_produk/'.$key->permalink.'/'.$key->poster.'/'.$key->id_produk);?>" method="post">
												<p>Apakah anda yakin ingin menghapus produk, <b><?= $key->nama_produk;?></b>? </p>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
													<button type="submit" class="btn btn-danger btn-sm">Hapus</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>

							<?php }?>
							<?php }?>
						</tbody>
					</table>
				</div>

				<?php if($produk != false){?>
				<?= $this->pagination->create_links(); ?>
				<?php }?>
			</div>
		</div>
	</div>
</div>
