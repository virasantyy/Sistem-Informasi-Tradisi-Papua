<?php
// $kategori = $koneksi->query("SELECT * FROM kategori");
// $jumlahkategori = $kategori->num_rows;

$informasi = $koneksi->query("SELECT * FROM informasi");
$jumlahinformasi = $informasi->num_rows;

$galeri = $koneksi->query("SELECT * FROM galeri");
$jumlahgaleri = $galeri->num_rows;

?>
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Beranda</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Beranda</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center" style="padding-top:10px">
            <div class="col-md-12">
                <img src="../foto/home.jpg" width="100%" style="height:350px;border-radius:10px;object-fit:cover">
            </div>
        </div>
        <br>
        <div class="row">

            <div class="col-md-4">
                <div class="card flat-card widget-purple-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="fa fa-list"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4><?php echo $jumlahinformasi ?></h4>
                            <h6>Jumlah Informasi</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card flat-card widget-primary-card">
                    <div class="row-table">
                        <div class="col-sm-3 card-body">
                            <i class="fas fa-book"></i>
                        </div>
                        <div class="col-sm-9">
                            <h4><?php echo $jumlahgaleri ?></h4>
                            <h6>Jumlah Galeri</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>