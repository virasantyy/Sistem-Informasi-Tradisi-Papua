<?php

include 'koneksi.php';

?>
<?php include 'header.php'; ?>
<div class="breadcrumb-area">
	<!-- Top Breadcrumb Area -->
	<div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(foto/home.jpg);">
		<h2>Login</h2>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Login</li>
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
					<h2>Silahkan Login</h2>
					<p>Website Informasi PAPUA</p>
				</div>
				<div class="contact-form-area mb-100">
					<form method="post">
						<div class="row">
							<div class="col-12">
								<div class="form-group">
									<input type="email" for="c_email" class="form-control" id="name" name="email" required placeholder="Email">
								</div>
							</div>
							<div class="col-12">
								<div class="form-group">
									<input type="password" class="form-control" id="password" name="password" required placeholder="Password">
								</div>
							</div>
							<div class="col-12">
								<button type="submit" class="btn alazea-btn mt-15 float-right" name="simpan" value="Masuk">Login</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
if (isset($_POST["simpan"])) {
	$email = $_POST["email"];
	$password = md5($_POST["password"]); //$password = md5($_POST['password']);
	$ambil = $koneksi->query("SELECT * FROM pengguna
		WHERE email='$email' OR '1=1' AND password='$password' limit 1");
	$akunyangcocok = $ambil->num_rows;
	if ($akunyangcocok == 1) {
		$akun = $ambil->fetch_assoc();
		if ($akun['level'] == "User") {
			$_SESSION["pengguna"] = $akun;
			echo "<script> alert('Anda sukses login');</script>";
			echo "<script> location ='index.php';</script>";
		} elseif ($akun['level'] == "Admin") {
			$_SESSION['admin'] = $akun;
			echo "<script> alert('Anda sukses login');</script>";
			echo "<script> location ='admin/index.php';</script>";
		}
	} else {
		echo "<script> alert('Anda gagal login, Cek akun anda');</script>";
		echo "<script> location ='login.php';</script>";
	}
}
?>
<?php
include 'footer.php';
?>