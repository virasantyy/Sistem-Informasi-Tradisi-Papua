<?php
$ambil = $koneksi->query("SELECT * FROM galeri WHERE idgaleri='$_GET[id]'");
$data = $ambil->fetch_assoc();
?>
<section class="pcoded-main-container">
	<div class="pcoded-content">
		<!-- [ breadcrumb ] start -->
		<div class="page-header">
			<div class="page-block">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="page-header-title">
							<h5 class="m-b-10">Ubah Galeri</h5>
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
							<li class="breadcrumb-item"><a href="#!">Ubah Galeri</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h5>Ubah Galeri</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<form method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label>Nama Galeri</label>
										<input type="text" required class="form-control" value=" <?php echo $data['namagaleri']; ?>" name="galeri">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Foto Galeri</label>
										<input type="file" class="form-control" name="foto">
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
	if (!empty($lokasifoto)) {
		move_uploaded_file($lokasifoto, "../foto/$namafoto");
		$koneksi->query("UPDATE galeri SET namagaleri='$_POST[galeri]',fotogaleri='$namafoto' WHERE idgaleri='$_GET[id]'");
	} else {
		$koneksi->query("UPDATE galeri SET namagaleri='$_POST[galeri]' WHERE idgaleri='$_GET[id]'");
	}
	echo "<script>alert('kGaleri Berhasil Di Ubah');</script>";
	echo "<script> location ='index.php?halaman=galeridaftar';</script>";
}
?>