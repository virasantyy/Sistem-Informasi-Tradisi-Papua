<section class="pcoded-main-container">
	<div class="pcoded-content">
		<!-- [ breadcrumb ] start -->
		<div class="page-header">
			<div class="page-block">
				<div class="row align-items-center">
					<div class="col-md-12">
						<div class="page-header-title">
							<h5 class="m-b-10">Tambah Kategori</h5>
						</div>
						<ul class="breadcrumb">
							<li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
							<li class="breadcrumb-item"><a href="#!">Tambah Kategori</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header">
						<h5>Tambah Kategori</h5>
					</div>
					<div class="card-body">
						<div class="row">
							<div class="col-md-12">
								<form method="post" enctype="multipart/form-data">
									<div class="form-group">
										<label>Nama Kategori</label>
										<input type="text" required class="form-control" name="kategori">
									</div>
									<div class="form-group">
										<label for="exampleInputPassword1">Foto Kategori</label>
										<input type="file" class="form-control" name="foto">
									</div>
									<button type="submit" class="btn float-right btn-primary" name="tambah">Simpan</button>
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
if (isset($_POST['tambah'])) {
	$namafoto = $_FILES['foto']['name'];
	$lokasifoto = $_FILES['foto']['tmp_name'];
	move_uploaded_file($lokasifoto, "../foto/" . $namafoto);
	$kategori = $_POST["kategori"];
	$koneksi->query("INSERT INTO kategori(namakategori,fotokategori)
		VALUES ('$kategori','$namafoto')");
	echo "<script> alert('Kategori Berhasil Di Tambah');</script>";
	echo "<script> location ='index.php?halaman=kategoridaftar';</script>";
}
?>