<?php
include 'koneksi.php';
include 'header.php';
$ambil = $koneksi->query("SELECT *FROM galeri order by idgaleri desc");
?>
<div class="breadcrumb-area">
    <!-- Top Breadcrumb Area -->
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(foto/home.jpg);">
        <h2>Galeri</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i>Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Galeri</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="alazea-portfolio-area section-padding-100-0">
    <div class="row justify-content-center alazea-portfolio">
        <?php while ($data = $ambil->fetch_assoc()) {
        ?>
            <div class="col-4 single_portfolio_item kemaro wow fadeInUp" data-wow-delay="300ms">
                <div class="portfolio-thumbnail bg-img" style="background-image: url(foto/<?= $data['fotogaleri'] ?>);"></div>
                <div class="portfolio-hover-overlay">
                    <a href="foto/<?= $data['fotogaleri'] ?>" class="portfolio-img d-flex align-items-center justify-content-center" title="<?= $data['namagaleri'] ?>">
                        <div class="port-hover-text">
                            <h3><?= $data['namagaleri'] ?></h3>
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</section>

<?php
include 'footer.php';
?>