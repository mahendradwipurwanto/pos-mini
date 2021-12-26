<div class="row justify-content-between align-items-center">
	<div class="col-md-12">
		<h4 class="title">Tambah Produk
			<a href="<?= site_url('produk');?>" class="btn btn-secondary btn-sm float-right">Batal</a>
		</h4>
	</div>
</div>
<hr>

<div class="row mt-2">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<form action="<?= site_url('admin/proses_tambahProduk');?>" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-9">
							<div class="form-group">
								<label for="inputNamaproduk">Nama produk <small class="text-danger">*</small></label>
								<input type="text" class="form-control" id="inputNamaproduk" name="nama_produk" maxlength="30"
									placeholder="Masukkan nama produk">
							</div>
							<div class="form-group">
								<div class="row">
									<div class="col-md-6">
										<label for="inputHargaproduk">Harga produk <small class="text-danger">*</small></label>
										<div class="input-group mb-3">
											<div class="input-group-prepend">
												<span class="input-group-text" id="InputHargaproduk">Rp.</span>
											</div>
											<input type="number" class="form-control" name="harga" placeholder="Masukkan harga produk"
												aria-label="Username" aria-describedby="InputHargaproduk" id="InputHargaproduk">
										</div>
									</div>
									<div class="col-md-6">
										<label for="inputkategoriproduk">Kategori <small class="text-danger">*</small></label>
										<select class="form-control select2" name="kategori" id="inputkategoriproduk">
											<option>Pilih kategori</option>
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
								<textarea type="text" class="form-control" id="ckeditor" name="keterangan" rows="3"
									placeholder="Masukkan keterangan produk"></textarea>
							</div>
						</div>
						<div class="col-md-3 border-left">
							<button type="submit" class="btn btn-primary btn-block btn-sm mb-4" id="send-button">tambahkan
								produk</button>
							<div class="form-group">
								<label for="inputPosterproduk">Poster produk <small class="text-danger">*</small></label>
								<label for="GETP_POSTER" class="upload-card mx-auto">
									<img id="P_POSTER" class="upload-img w-100 P_POSTER cursor"
										src="<?= base_url() . 'assets/img/placeholder.png' ?>" alt="Placeholder">
								</label>
								<input type="file" id="GETP_POSTER" class="form-control d-none" name="poster"
									onchange="previewP_POSTER(this);" accept="image/*">
								<small class="text-muted">Max 2Mb size.</small>
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

	function previewP_POSTER(input) {
		$(".P_POSTER").removeClass('hidden');
		var file = $("#GETP_POSTER").get(0).files[0];

		if (file) {
			var reader = new FileReader();

			reader.onload = function () {
				$("#P_POSTER").attr("src", reader.result);
			}

			reader.readAsDataURL(file);
		}
	}

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
