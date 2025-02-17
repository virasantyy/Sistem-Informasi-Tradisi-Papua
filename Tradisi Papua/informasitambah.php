<?php
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
	$datakategori[] = $tiap;
}
?>
<section class="pcoded-main-container">
	<div class="pcoded-content">
		<div class="page-header">
			<div class="page-block">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="page-header-title">
							<h5 class="m-b-10">Tambah Informasi</h5>
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
							<li class="breadcrumb-item"><a href="#!">Tambah Informasi</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h5>Tambah Informasi</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<form method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label>Nama</label>
										<input type="text" required class="form-control" name="judul">
									</div>
									<div class="form-group">
										<label class="mb-2">Kategori</label>
										<select class="form-control" name="idkategori">
											<option value="">Pilih Kategori</option>
											<?php foreach ($datakategori as $key => $value) : ?>
												<option value="<?php echo $value["idkategori"] ?>"><?php echo $value["namakategori"] ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="form-group">
										<label class="mb-2">Deskripsi</label>
										<textarea class="form-control ckeditor" name="lirik" id="lirik" rows="10"></textarea>
									</div>
									<div class="form-group">
										<label>Foto</label>
										<div class="row">
											<div class="col-md-10">
												<div class="letak-input" style="margin-bottom: 10px;">
													<input type="file" class="form-control" name="foto[]" onchange="previewImage(event)">
												</div>
											</div>
											<div class="col-md-2">
												<span class="btn btn-primary btn-tambah">
													<i class="fa fa-plus"></i>
												</span>
											</div>
										</div>
										<div class="row">
											<div class="col">
												<img id="uploaded-image" class="img-fluid" alt="">
											</div>
										</div>
									</div>
									<button type="submit" class="btn float-right btn-primary" name="save">Simpan</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</section>
<?php
if (isset($_POST['save'])) {
	$namafoto = $_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];
	$koneksi->query("INSERT INTO informasi
		(judul,penulis,idkategori,lirik)
		VALUES('$_POST[judul]','$_POST[penulis]','$_POST[idkategori]','$_POST[lirik]')")  or die(mysqli_error($koneksi));
	$idinformasi = $koneksi->insert_id;
	foreach ($namafoto as $key => $foto) {
		$tiaplokasi = $lokasifoto[$key];
		move_uploaded_file($tiaplokasi, "../foto/" . $foto);
		$koneksi->query("INSERT INTO informasifoto(idinformasi,fotoinformasi)
			VALUES('$idinformasi','$foto')")  or die(mysqli_error($koneksi));
	}
	echo "<script>alert('Informasi Berhasil Di Simpan');</script>";
	echo "<script> location ='index.php?halaman=informasidaftar';</script>";
}
?>
<script src="assets/js/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$(".btn-tambah").on("click", function() {
			$(".letak-input").append("<div class='input-group' style='margin-top:10px'><input type='file' class='form-control' name='foto[]'><span class='btn btn-danger btn-remove'><i class='fa fa-trash'></i></span></div>");
		})

		$(document).on('click', '.btn-remove', function() {
			$(this).closest('.input-group').remove();
		});
	})

	function previewImage(event) {
		var uploadedImage = document.getElementById('uploaded-image');
		uploadedImage.src = URL.createObjectURL(event.target.files[0]);
	}
</script>