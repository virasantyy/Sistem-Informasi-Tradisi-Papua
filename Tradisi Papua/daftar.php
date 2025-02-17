<?php

include 'koneksi.php';

?>
<?php include 'header.php'; ?>
<div class="breadcrumb-area">
	<div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(home/assets/assets_home/img/bg-img/buketdua.jpg);">
		<h2>Daftar</h2>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Daftar</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<section class="contact-area">
	<div class="container">
		<div class="row align-items-center justify-content-center">
			<div class="col-6 col-lg-5">
				<div class="section-heading text-center">
					<h2>Daftar</h2>
				</div>
				<div class="contact-form-area mb-100">
					<form method="post">
						<div class="row">
							<div class="col-6 col-md-12">
								<div class="form-group">
									<label>Nama</label>
									<input type="text" class="form-control" name="nama" placeholder="Masukkan Nama">
								</div>
							</div>
							<div class="col-12 col-md-12">
								<div class="form-group">
									<label>Email</label>
									<input type="email" class="form-control" name="email" placeholder="Masukkan Email">
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Password</label>
									<input type="text" class="form-control" name="password" placeholder="Masukkan Password">
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>No. HP</label>
									<input type="number" class="form-control" name="nohp" placeholder="Masukkan No.No. HP">
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<label>Alamat</label>
									<textarea class="form-control" name="alamat" required cols="30" rows="10" placeholder="Alamat"></textarea>
								</div>
							</div>
							<div class="col-12">
								<button type="submit" class="btn alazea-btn mt-15 float-right" name="daftar">Daftar</button>
							</div>
						</div>
					</form>
				</div>
			</div>

		</div>
	</div>
</section>
<?php
if (isset($_POST["daftar"])) {
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$alamat = $_POST['alamat'];
	$nohp = $_POST['nohp'];
	$ambil = $koneksi->query("SELECT*FROM pengguna 
							WHERE email='$email'");
	$yangcocok = $ambil->num_rows;
	if ($yangcocok == 1) {
		echo "<script>alert('Pendaftaran Gagal, email sudah ada')</script>";
		echo "<script>location='daftar.php';</script>";
	} else {
		$koneksi->query("INSERT INTO pengguna	(nama, email,  password, alamat, nohp, fotoprofil, level)
								VALUES('$nama','$email','$password','$alamat','$nohp','user.png','User')");
		echo "<script>alert('Pendaftaran Berhasil')</script>";
		echo "<script>location='login.php';</script>";
	}
}
?>
<?php
include 'footer.php';
?>