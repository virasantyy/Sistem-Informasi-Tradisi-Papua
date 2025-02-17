<?php
include 'koneksi.php';
include 'header.php';
$idkategori = $_GET['id'];
$ambilrow = $koneksi->query("SELECT * FROM kategori WHERE idkategori='$_GET[id]'");
$row = $ambilrow->fetch_assoc();
$ambil = $koneksi->query("SELECT *FROM informasi LEFT JOIN kategori ON informasi.idkategori=kategori.idkategori where informasi.idkategori='$idkategori' order by idinformasi desc");
?>
<div class="breadcrumb-area">
    <!-- Top Breadcrumb Area -->
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(foto/home.jpg);">
        <h2><?= $row['namakategori'] ?></h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i>Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $row['namakategori'] ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="shop-page section-padding-0-80">
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


            <div class="col-12 col-md-8 col-lg-12">
                <div class="shop-products-area">
                    <div class="row">
                        <?php while ($data = $ambil->fetch_assoc()) {
                            $ambilfoto = $koneksi->query("SELECT * FROM informasifoto WHERE idinformasi='$data[idinformasi]' limit 1");
                            $foto = $ambilfoto->fetch_assoc();
                        ?>
                            <div class="col-12 col-sm-6 col-lg-6">
                                <div class="single-product-area mb-50">

                                    <div class="product-img">
                                        <a href="detail.php?id=<?php echo $data['idinformasi']; ?>"><img style="height:300px;" src="foto/<?php echo $foto['fotoinformasi'] ?>" alt=""></a>
                                    </div>

                                    <div class="product-info mt-15 text-center">
                                        <a href="detail.php?id=<?php echo $data['idinformasi']; ?>">
                                            <p style="font-size:12pt" class="btn alazea-btn"><?php echo $data['judul'] ?></p>
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