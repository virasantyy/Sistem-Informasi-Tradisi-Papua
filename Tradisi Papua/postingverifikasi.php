<?php
$ambilposting = $koneksi->query("SELECT * FROM posting left join informasi on posting.idinformasi = informasi.idinformasi left join pengguna on posting.idpengguna = pengguna.id WHERE idposting='$_GET[id]'");
$data = $ambilposting->fetch_assoc();
?>
<section class="pcoded-main-container">
    <div class="pcoded-content">

        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Daftar Peserta</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="#!">Daftar Peserta</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Verifikasi Posting</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-lg-12">
                                <div class="single-product-area mb-50">
                                    <div class="row mb-3">
                                        <div class="col-md-1 col-2">
                                            <img src="../foto/<?= $data['fotoprofil'] ?>" width="100%" class="imageround">
                                        </div>
                                        <div class="col-md-8 col-10">
                                            <h5><b><?= $data['nama'] ?></b></h5>
                                            <ul style="list-style-type:none;padding-left:0px">
                                                <li><i class="fa fa-calendar text-green"></i> <?= tanggal(date("Y-m-d", strtotime($data['waktu']))) . ' ' . date("H:i", strtotime($data['waktu'])); ?> W.I.B
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <?php
                                            $no = 1;
                                            $ambilfoto = $koneksi->query("SELECT * FROM postingfoto where idposting='$data[idposting]'");
                                            while ($foto = $ambilfoto->fetch_assoc()) {
                                                if ($no == '1') {
                                                    $aktif = "active";
                                                } else {
                                                    $aktif = "";
                                                }
                                            ?>
                                                <div class="carousel-item <?= $aktif ?>">
                                                    <?php
                                                    $path = '../foto/' . $foto['fotoposting'];
                                                    $extension = pathinfo($path, PATHINFO_EXTENSION);
                                                    ?>
                                                    <?php if ($extension == 'mp4') { ?>
                                                        <video width="100%" style="height: 550px;" controls>
                                                            <source src="<?php echo '../foto/' . $foto['fotoposting']; ?>" type="video/mp4" style="height: 500px !important;">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    <?php } else { ?>
                                                        <img src="../foto/<?= $foto['fotoposting'] ?>" style="border-radius:10px;width:100%;height:550px;object-fit:cover; !important" alt="">
                                                    <?php } ?>
                                                </div>
                                            <?php
                                                $no++;
                                            }
                                            ?>
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                    <div class="product-info mt-3 text-justify">
                                        <p><?php echo $data['caption'] ?></p>
                                    </div>
                                    <form method="post">
                                        <div class="form-group">
                                            <label>Pilih Status</label>
                                            <input type="hidden" name="idpengguna" class="form-control" value="<?= $data['idpengguna'] ?>">
                                            <select name="status" class="form-control" required>
                                                <option <?php if ($data['status'] == 'Di Terima') echo 'selected'; ?> value="Di Terima">Di Terima</option>
                                                <option <?php if ($data['status'] == 'Di Tolak') echo 'selected'; ?> value="Di Tolak">Di Tolak</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" name="simpan" class="btn btn-primary float-right">Simpan
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
if (isset($_POST["simpan"])) {
    $status = $_POST['status'];
    $koneksi->query("UPDATE posting SET status='$status' WHERE idposting='$_GET[id]'");
    echo "<script>alert('Verifikasi berhasil di simpan')</script>";
    echo "<script> location ='index.php?halaman=postingdaftar';</script>";
}
?>