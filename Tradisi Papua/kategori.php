<?php

include 'koneksi.php';
?>
<?php include 'header.php';
$kategori = $_GET["id"];
$semuadata = array();
$ambil = $koneksi->query("SELECT*FROM informasi WHERE idkategori LIKE '%$kategori%'");
while ($data = $ambil->fetch_assoc()) {
	$semuadata[] = $data;
}
?>
<?php
$datakategori = array();
$ambil = $koneksi->query("SELECT * FROM kategori");
while ($tiap = $ambil->fetch_assoc()) {
	$datakategori[] = $tiap;
}
?>
<?php $am = $koneksi->query("SELECT * FROM kategori where idkategori='$kategori'");
$pe = $am->fetch_assoc()
?>
<div class="breadcrumb-area">
	<!-- Top Breadcrumb Area -->
	<div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(foto/home.jpg);">
		<h2> <?php echo $pe["namakategori"] ?></h2>
	</div>

	<div class="container">
		<div class="row">
			<div class="col-12">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
						<li class="breadcrumb-item active" aria-current="page"> <?php echo $pe["namakategori"] ?></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<section class="shop-page section-padding-0-100">
	<div class="container">
		<div class="row">
			<!-- Shop Sorting Data -->
			<div class="col-12">
				<div class="shop-sorting-data d-flex flex-wrap align-items-center justify-content-between">
				</div>
			</div>
		</div>

		<div class="row">
			<!-- Sidebar Area -->
			<div class="col-12 col-md-4 col-lg-3">
				<div class="shop-sidebar-area">
				</div>
			</div>

			<!-- All Products Area -->
			<div class="col-12 col-md-12 col-lg-12">
				<div class="shop-products-area">
					<div class="row">
						<?php foreach ($semuadata as $key => $perinformasi) {
							$ambilfoto = $koneksi->query("SELECT * FROM informasifoto WHERE idinformasi='$perinformasi[idinformasi]' limit 1");
							$foto = $ambilfoto->fetch_assoc();
						?>
							<div class="col-12">
								<div class="single-product-area mb-50">
									<!-- Product Image -->
									<div class="product-img">
										<a href="detail.php?id=<?php echo $perinformasi['idinformasi']; ?>"><img style="" src="foto/<?php echo $foto['fotoinformasi'] ?>" alt=""></a>
									</div>
									<!-- Product Info -->
									<div class="product-info mt-15 text-center">
										<a href="detail.php?id=<?php echo $perinformasi['idinformasi']; ?>">
											<p><?php echo $perinformasi['judul'] ?></p>
										</a>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
include 'footer.php';
?>