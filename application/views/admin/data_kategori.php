<div class="row">
	<div class="col-md-10">
		<div class="card">
			<div class="card-header">
				<h4 class="card-header-title">Data kategori
					<button type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal"
						data-target="#tambah-kategori">tambah kategori</button>
				</h4>
			</div>
			<div class="card-body">
				<div class="table-responsive mb-4">
					<table class="table table-stripped table-nowrap">
						<thead class="thead-light">
							<tr>
								<th>No</th>
								<th></th>
								<th>Kategori</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<?php if($kategori == false){?>
							<tr>
								<td colspan="4" class="text-center">belum ada data</td>
							</tr>
							<?php }else{?>
							<?php $no = 1; foreach ($kategori as $key) {?>
							<tr>
								<th><?= $no++;?></th>
								<td>
									<button type="button" class="btn btn-info btn-sm" data-toggle="modal"
										data-target="#edit-kategori-<?= $key->id_kategori;?>">ubah</button>
									<button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
										data-target="#hapus-kategori-<?= $key->id_kategori;?>">hapus</button>
								</td>
								<td><?= $key->kategori;?></td>
								<td><?= $key->keterangan;?></td>
							</tr>

							<!-- Modal -->
							<div class="modal fade" id="edit-kategori-<?= $key->id_kategori;?>" tabindex="-1" role="dialog"
								aria-labelledby="edit-kategori-<?= $key->id_kategori;?>" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle">Edit kategori</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="<?= site_url('admin/edit_kategori');?>" method="post">
												<input type="hidden" name="id_kategori" value="<?= $key->id_kategori;?>">
												<div class="form-group">
													<label for="inputKategori" class="input-label">Nama Kategori <small
															class="text-danger">*</small></label>
													<input type="text" class="form-control" id="inputKategori" name="kategori"
														value="<?= $key->kategori;?>">
												</div>
												<div class="form-group">
													<label for="inputKeterangan" class="input-label">Keterangan <small
															class="text-muted">(optional)</small></label>
													<textarea type="text" class="form-control" id="inputKeterangan" rows="3"
														name="keterangan"><?= $key->keterangan;?></textarea>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
													<button type="submit" class="btn btn-info btn-sm">Ubah</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>

							<!-- Modal -->
							<div class="modal fade" id="hapus-kategori-<?= $key->id_kategori;?>" tabindex="-1" role="dialog"
								aria-labelledby="edit-kategori-<?= $key->id_kategori;?>" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLongTitle">Edit kategori</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="<?= site_url('admin/hapus_kategori/'.$key->id_kategori);?>" method="post">
												<p>Apakah anda yakin ingin menghapus kategori, <b><?= $key->kategori;?></b>? </p>
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

				<?php if($kategori != false){?>
				<?= $this->pagination->create_links(); ?>
				<?php }?>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="tambah-kategori" tabindex="-1" role="dialog" aria-labelledby="tambah-kategori"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Tambah kategori</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="<?= site_url('admin/tambah_kategori');?>" method="post">
					<div class="form-group">
						<label for="inputKategori" class="input-label">Nama Kategori <small class="text-danger">*</small></label>
						<input type="text" class="form-control" id="inputKategori" name="kategori"
							placeholder="Masukkan nama kategori">
					</div>
					<div class="form-group">
						<label for="inputKeterangan" class="input-label">Keterangan <small
								class="text-muted">(optional)</small></label>
						<textarea type="text" class="form-control" id="inputKeterangan" rows="3" name="keterangan"
							placeholder="Masukkan nama kategori"></textarea>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary btn-sm">Tambah</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
