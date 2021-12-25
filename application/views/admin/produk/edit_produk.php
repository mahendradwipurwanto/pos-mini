<div class="row justify-content-between align-items-center">
	<div class="col-md-12">
		<h4 class="title">Edit Produk - <?= $produk->nama_produk;?>
			<a href="<?= site_url('produk');?>" class="btn btn-secondary btn-sm float-right">Batal</a>
		</h4>
	</div>
</div>
<hr>

<div class="row mt-2">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
        <form action="<?= site_url('admin/proses_editProduk');?>" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id_produk" value="<?= $produk->id_produk;?>" required>
        <input type="hidden" name="permalink" value="<?= $produk->permalink;?>" required>
					<div class="row">
						<div class="col-md-9">
							<div class="form-group">
								<label for="inputNamaproduk">Nama produk <small class="text-danger">*</small></label>
								<input type="text" class="form-control" id="inputNamaproduk" name="nama_produk" maxlength="30"
									value="<?= $produk->nama_produk;?>">
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6">
										<label for="inputHargaproduk">harga produk <small class="text-danger">*</small></label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="InputHargaproduk">Rp.</span>
											</div>
											<input type="number" class="form-control" name="harga" value="<?= $produk->harga;?>"
												aria-label="Username" aria-describedby="InputHargaproduk" id="InputHargaproduk">
										</div>
									</div>
									<div class="col-md-6">
										<label for="inputkategoriproduk">Kategori <small class="text-danger">*</small></label>
										<select class="form-control select2" name="kategori">
											<option value="<?= $produk->id_kategori;?>"><?= $produk->kategori;?></option>
                      <?php if($kategori != false){?>
                        <?php foreach ($kategori as $key) {?>
                          <option value="<?= $key->id_kategori;?>"><?= $key->kategori;?></option>
                        <?php }?>
                      <?php }?>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="ckeditor">Keterangan <small class="text-danger">*</small></label>
								<textarea type="text" class="form-control" id="ckeditor" name="keterangan" rows="3"><?= $produk->keterangan;?></textarea>
							</div>
						</div>
						<div class="col-md-3 border-left">
							<button type="submit" class="btn btn-info btn-block btn-sm" id="send-button">edit produk</button>
							<div class="form-group">
								<label for="inputPosterproduk">Poster produk <small class="text-danger">*</small></label>
								<input type="file" class="form-control" id="inputPosterproduk" name="poster" value="<?= $produk->poster;?>">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



<script type="text/javascript">
	$('form').submit(function (event) {
		$('#send-button').prop("disabled", true);
		// add spinner to button
		$('#send-button').html(
			`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> memuat...`
		);
		return;
  });
  
	$(document).ready(function () {
		$("#inputNamaproduk").keydown(function (event) {
			var inputValue = event.which;
			// allow letters and whitespaces only.
			if (!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0 &&
					inputValue != 8 && inputValue != 37 && inputValue != 39)) {
				event.preventDefault();
			}
		});
	});

	$("#InputHargaproduk").keyup(function () {
		var value = $(this).val();
		value = value.replace(/^(0*)/, "");
		$(this).val(value);
	});

	// Restricts input for the given textbox to the given inputFilter.
	function setInputFilter(textbox, inputFilter) {
		["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function (event) {
			textbox.addEventListener(event, function () {
				if (inputFilter(this.value)) {
					this.oldValue = this.value;
					this.oldSelectionStart = this.selectionStart;
					this.oldSelectionEnd = this.selectionEnd;
				} else if (this.hasOwnProperty("oldValue")) {
					this.value = this.oldValue;
					this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
				} else {
					this.value = "";
				}
			});
		});
	}

	// Install input filters Tambah Hp Pegawai.
	setInputFilter(document.getElementById("InputHargaproduk"), function (value) {
		return /^\d*$/.test(value);
	});

</script>
