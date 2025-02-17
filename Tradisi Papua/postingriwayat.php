<?php
include 'koneksi.php';
include 'header.php';
$idpengguna = $_SESSION["pengguna"]['id'];
$ambil = $koneksi->query("SELECT * FROM posting left join informasi on posting.idinformasi = informasi.idinformasi left join pengguna on posting.idpengguna = pengguna.id where posting.idpengguna = '$idpengguna' order by idposting desc");
?>
<div class="breadcrumb-area">
    <!-- Top Breadcrumb Area -->
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(foto/home.jpg);">
        <h2>Riwayat Postingan Anda</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Riwayat Postingan Anda</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="shop-page section-padding-0-100">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-8 col-lg-12" style="padding-top:50px">
                <h2 class="mb-5">Riwayat Postingan Anda</h2>
                <div class="shop-products-area">
                    <div class="row">
                        <?php while ($data = $ambil->fetch_assoc()) {
                            $idposting = $data['idposting'];
                        ?>
                            <div class="col-12 col-sm-12 col-lg-12">
                                <div class="single-product-area mb-50">
                                    <a class="btn btn-secondary text-white mb-3">
                                        <?= $data['status'] ?>
                                    </a>
                                    <div class="row mb-3">
                                        <div class="col-md-1 col-2">
                                            <img src="foto/<?= $data['fotoprofil'] ?>" width="100%" class="imageround">
                                        </div>
                                        <div class="col-md-10 col-8">
                                            <h5><b><?= $data['nama'] ?></b></h5>
                                            <ul class="labelbuttongrey">
                                                <li><i class="fa fa-calendar text-green"></i> <?= tanggal(date("Y-m-d", strtotime($data['waktu']))) . ' ' . date("H:i", strtotime($data['waktu'])); ?> W.I.B
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-md-1 col-2">
                                            <a href="postinghapus.php?id=<?= $data['idposting'] ?>" class="btn btn-danger text-white float-right" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data ?')"><i class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                    <div id="carouselExampleIndicators" class="carousel slide">
                                        <div class="carousel-inner">
                                            <?php
                                            $no = 1;
                                            $ambilfoto = $koneksi->query("SELECT * FROM postingfoto where idposting='$data[idposting]'");
                                            while ($foto = $ambilfoto->fetch_assoc()) {
                                                if ($no == 1) {
                                                    $aktif = "active";
                                                } else {
                                                    $aktif = "";
                                                }
                                            ?>
                                                <div class="carousel-item <?= $aktif ?>">
                                                    <?php
                                                    $path = 'foto/' . $foto['fotoposting'];
                                                    $extension = pathinfo($path, PATHINFO_EXTENSION);
                                                    ?>
                                                    <?php if ($extension == 'mp4') { ?>
                                                        <video width="100%" style="height: 700px;" controls>
                                                            <source src="<?php echo 'foto/' . $foto['fotoposting']; ?>" type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    <?php } else { ?>
                                                        <img src="foto/<?php echo $foto["fotoposting"]; ?>" width="100%" style="object-fit: cover; height: 700px!important" alt="">
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
                                    <div class="product-info mt-15 text-justify">
                                        <p><?php echo $data['caption'] ?></p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            $ambilhitunglike = mysqli_query($koneksi, "SELECT * FROM likedislike where idposting = '$idposting' and jenis='Like'");
                                            $hitunglike = $ambilhitunglike->num_rows;
                                            $ambilhitungdislike = mysqli_query($koneksi, "SELECT * FROM likedislike where idposting = '$idposting' and jenis='Dislike'");
                                            $hitungdislike = $ambilhitungdislike->num_rows;


                                            if (isset($_SESSION["pengguna"])) {
                                                $idpengguna = $_SESSION['pengguna']['id'];
                                            ?>
                                                <?php
                                                $ambilceklike = mysqli_query($koneksi, "SELECT * FROM likedislike where idposting = '$idposting' and id='$idpengguna' and jenis='Like'");
                                                $ceklike = $ambilceklike->num_rows;
                                                if ($ceklike >= 1) {
                                                    $aktif = "aktif";
                                                } else {
                                                    $aktif = "";
                                                }
                                                ?>
                                                <a href="likeriwayat.php?idposting=<?= $idposting ?>&jenis=Like"><i class="fa fa-thumbs-up fa-6x thumbs-icon <?= $aktif ?>"><?= $hitunglike ?></i></a>
                                                &nbsp;
                                                &nbsp;
                                                <?php
                                                $ambilcekdislike = mysqli_query($koneksi, "SELECT * FROM likedislike where idposting = '$idposting' and id='$idpengguna' and jenis='Dislike'");
                                                $cekdislike = $ambilcekdislike->num_rows;
                                                if ($cekdislike >= 1) {
                                                    $aktif = "aktif";
                                                } else {
                                                    $aktif = "";
                                                }
                                                ?>
                                                <a href="likeriwayat.php?idposting=<?= $idposting ?>&jenis=Dislike"><i class="fa fa-thumbs-down fa-6x thumbs-icon <?= $aktif ?>"><?= $hitungdislike ?></i></a>
                                            <?php } else { ?>
                                                <i class="fa fa-thumbs-up fa-6x thumbs-icon"><?= $hitunglike ?></i>
                                                &nbsp;
                                                &nbsp;
                                                <i class="fa fa-thumbs-down fa-6x thumbs-icon"><?= $hitungdislike ?></i>
                                            <?php } ?>
                                            &nbsp;
                                            &nbsp;
                                            <span class="share-button sharer">
                                                <a type="button" class="share-btn"> <i class="fa fa-share fa-6x sharing"></i></a>
                                                <div class="social top center networks-5" style="padding-left:100px">
                                                    <?php
                                                    $url = "papuagoodguide.com/postingdetail.php?id=$idposting";
                                                    $urlfb = "papuagoodguide.com/postingdetail.php?id=$idposting";
                                                    ?>
                                                    <a class="fbtn share facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?= $urlfb ?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                                    <a class="fbtn share whatsapp" data-url="<?= $url ?>" href="whatsapp://send?text=Postingan Web <?= $url ?>" data-action="share/whatsapp/share" target="_blank"><i class="fa fa-whatsapp"></i></a>
                                                    <a class="fbtn share gplus share-link" data-url="<?= $url ?>"><i class="fa fa-share sharing text-white"></i></a>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <?php
                                                $ambilkomentar = $koneksi->query("SELECT *FROM komentar join pengguna on komentar.id = pengguna.id where idposting='$idposting' order by idkomentar asc");
                                                while ($komentar = $ambilkomentar->fetch_assoc()) {
                                                ?>
                                                    <div class="col-md-12">
                                                        <div class="row mt-5">
                                                            <div class="col-md-1 col-2">
                                                                <img src="foto/user.png" width="50px">
                                                            </div>
                                                            <div class="col-md-11 col-10">
                                                                <div class="card">
                                                                    <div class="card-body">
                                                                        <div class="d-flex justify-content-between">
                                                                            <h5 style="margin:0px">
                                                                                <?= $komentar['nama'] ?>
                                                                            </h5>
                                                                            <p class="date"> <?= tanggal(date("Y-m-d", strtotime($komentar['waktu']))) . ' ' . date("H:i", strtotime($komentar['waktu'])); ?> W.I.B</p>
                                                                        </div>
                                                                        <span style="font-size:9pt"><?= $komentar['alamat'] ?></span>
                                                                        <br>
                                                                        <br>
                                                                        <div class="row align-items-end">
                                                                            <div class="col-md-12">
                                                                                <p class="comment">
                                                                                    <?= $komentar['komentar'] ?>
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
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
<?php
if (isset($_POST['posting'])) {
    $idjadwal = $_GET['id'];
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];
    $koneksi->query("INSERT INTO posting
		(idpengguna,idinformasi,caption,status)
		VALUES('$idpengguna','$_POST[idinformasi]','$_POST[caption]','Menunggu Konfirmasi Admin')")  or die(mysqli_error($koneksi));
    $idposting = $koneksi->insert_id;
    foreach ($namafoto as $key => $foto) {
        $tiaplokasi = $lokasifoto[$key];
        move_uploaded_file($tiaplokasi, "foto/" . $foto);
        $koneksi->query("INSERT INTO postingfoto(idposting,fotoposting)
			VALUES('$idposting','$foto')")  or die(mysqli_error($koneksi));
    }
    echo "<script>alert('Postingan anda berhasil diupload, jika sudah dikonfirmasi admin, postingan anda otomatis akan muncul di linimasa');</script>";
    echo "<script> location ='postingriwayat.php';</script>";
}
?>
<script>
    $(document).ready(function() {
        $(".btn-tambah").on("click", function() {
            $(".letak-input").append("<div class='input-group' style='margin-top:10px'><input type='file' class='form-control' name='foto[]'><span class='btn btn-danger btn-remove'><i class='fa fa-trash'></i></span></div>");
        })

        $(document).on('click', '.btn-remove', function() {
            $(this).closest('.input-group').remove();
        });
    })
</script>