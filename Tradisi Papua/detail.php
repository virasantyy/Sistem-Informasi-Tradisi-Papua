<?php

include 'koneksi.php';
?>
<?php
$idinformasi = $_GET["id"];
$ambil = $koneksi->query("SELECT*FROM informasi LEFT JOIN kategori ON informasi.idkategori=kategori.idkategori WHERE idinformasi='$idinformasi'");
$detail = $ambil->fetch_assoc();
$kategori = $detail["idkategori"];
?>
<?php include 'header.php'; ?>
<div class="breadcrumb-area">
	<div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(foto/home.jpg);">
		<h2>Informasi Detail</h2>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Berita Detail</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<main>
	<div class="product_image_area">
		<div class="container">
			<div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);border:none;padding:25px">
				<div class="card-body">
					<div class="row mt-3">
						<?php
						$ambilfoto = $koneksi->query("SELECT * FROM informasifoto WHERE idinformasi='$detail[idinformasi]'");
						while ($foto = $ambilfoto->fetch_assoc()) {
						?>
							<div class="col-md-3">
								<img src="foto/<?php echo $foto['fotoinformasi']; ?>" width="100%" style="height: 250px;object-fit:cover">
							</div>
						<?php } ?>
					</div>
					<div class="text-center" style="padding-top: 35px; padding-bottom: 35px">
						<h2><?= $detail["judul"] ?></h2>
						<br>
						<br>
						<h4><b>Deskripsi :</b></h4>
						<h4>
							<p>
								<?= $detail["lirik"] ?>
							</p>
						</h4>
					</div>
				</div>
			</div>
		</div>
	</div>
</main>
<?php
$ambil = $koneksi->query("SELECT *FROM informasi LEFT JOIN kategori ON informasi.idkategori=kategori.idkategori where idinformasi != '$idinformasi' order by idinformasi desc");
?>
<br><br>
<section class="popular-items latest-padding">
	<div class="container">
		<div class="row product-btn justify-content-center mb-40">
			<div class="grid-list-view">
				<h2>Informasi lainnya</h2><br>
			</div>
		</div>
		<div class="row">
			<?php while ($perinformasi = $ambil->fetch_assoc()) {
				$ambilfoto = $koneksi->query("SELECT * FROM informasifoto WHERE idinformasi='$perinformasi[idinformasi]' limit 1");
				$foto = $ambilfoto->fetch_assoc();
			?>
				<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
					<div class="single-popular-items mb-50 text-center">
						<div class="popular-img">
							<img style="width: 100%;height:250px; margin-bottom: 10px;" src="foto/<?php echo $foto['fotoinformasi'] ?>" alt="">
						</div>
						<div class="popular-caption">
							<a href="detail.php?id=<?php echo $perinformasi['idinformasi']; ?>" style="font-size: 16px" class="btn alazea-btn">
								<?php echo $perinformasi['judul'] ?>
							</a>
						</div>

					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>
<?php
include 'footer.php';
?>