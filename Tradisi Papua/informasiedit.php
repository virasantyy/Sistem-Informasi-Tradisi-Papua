<?php
$ambil = $koneksi->query("SELECT * FROM informasi WHERE idinformasi='$_GET[id]'");
$data = $ambil->fetch_assoc();
?>
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
							<h5 class="m-b-10">Ubah Informasi</h5>
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
							<li class="breadcrumb-item"><a href="#!">Ubah Informasi</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h5>Ubah Informasi</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<form method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label>Nama</label>
										<input type="text" required class="form-control" value="<?php echo $data['judul']; ?>" name="judul">
									</div>
									<div class="form-group">
										<label class="mb-2">Kategori</label>
										<select class="form-control" name="idkategori">
											<option value="">Pilih Kategori</option>
											<?php foreach ($datakategori as $key => $value) : ?>
												<option <?php if ($value['idkategori'] == $data['idkategori']) echo 'selected'; ?> value="<?php echo $value["idkategori"] ?>"><?php echo $value["namakategori"] ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<div class="form-group">
										<label class="mb-2">Deskripsi</label>
										<textarea class="form-control ckeditor" name="lirik" id="lirik" rows="10"><?php echo $data['lirik']; ?></textarea>
									</div>
									<div class="form-group">
										<div class="row">
											<?php
											$ambilfoto = $koneksi->query("SELECT * FROM informasifoto where idinformasi='$data[idinformasi]'");
											while ($foto = $ambilfoto->fetch_assoc()) {
											?>
												<div class="col-md-3">
													<img src="../foto/<?php echo $foto['fotoinformasi']; ?>" width="100%" style="height: 250px;object-fit:cover">
													<a class="btn btn-danger mt-3 float-right" href="fotohapus.php?id=<?= $foto['idinformasifoto'] ?>&idinformasi=<?= $data['idinformasi'] ?>" onclick="return confirm('Apakah anda yakin ingin menghapus foto ini ?')">Hapus Foto</a>
												</div>
											<?php } ?>
										</div>
									</div>
									<div class="form-group">
										<label>Tambah Foto</label>
										<div class="row">
											<div class="col-md-10">
												<div class="letak-input">
													<input type="file" class="form-control" name="foto[]">
												</div>
											</div>
											<div class="col-md-2">
												<span class="btn btn-primary btn-tambah">
													<i class="fa fa-plus"></i>
												</span>
											</div>
										</div>
									</div>
									<button type="submit" class="btn float-right btn-primary" name="ubah">Simpan</button>
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
if (isset($_POST['ubah'])) {
	$namafoto = $_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];
	$koneksi->query("UPDATE informasi SET judul='$_POST[judul]',idkategori='$_POST[idkategori]',lirik='$_POST[lirik]' WHERE idinformasi='$_GET[id]'") or die(mysqli_error($koneksi));
	foreach ($namafoto as $key => $tiapnama) {
		$tiaplokasi = $lokasifoto[$key];
		move_uploaded_file($tiaplokasi, "../foto/" . $tiapnama);
		if ($tiapnama != "") {
			$koneksi->query("INSERT INTO informasifoto(idinformasi, fotoinformasi)
			VALUES('$_GET[id]','$tiapnama')");
		}
	}
	echo "<script>alert('Data Informasi Berhasil Diubah');</script>";
	echo "<script>location='index.php?halaman=informasidaftar';</script>";
}
?>
<script>
	$(document).ready(function() {
		$(".btn-tambah").on("click", function() {
			$(".letak-input").append("<input type='file' class='form-control mt-3' name='foto[]'>");
		})
	})
</script>
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
</script>