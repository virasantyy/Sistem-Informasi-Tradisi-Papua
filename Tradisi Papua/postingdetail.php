<?php
include 'koneksi.php';
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
            <?php
            $ambil = $koneksi->query("SELECT * FROM posting left join informasi on posting.idinformasi = informasi.idinformasi left join pengguna on posting.idpengguna = pengguna.id where posting.status = 'Di Terima' order by idposting desc");
            $data = $ambil->fetch_assoc();
            $noposting = 1;
            $idposting = $data['idposting'];
            $ambilulasan = mysqli_query($koneksi, "SELECT sum(bintang) as totalbintang FROM ulasan where ulasan.idposting = '$idposting'");
            $dataulasan = $ambilulasan->fetch_assoc();
            $ambilulasan = mysqli_query($koneksi, "SELECT * FROM ulasan where ulasan.idposting = '$idposting'");
            $hitungulasan = $ambilulasan->num_rows;
            if ($hitungulasan == 0) {
                $jumlahulasan = 1;
            } else {
                $jumlahulasan = $hitungulasan;
            }
            $rataulasan = $dataulasan['totalbintang'] / $jumlahulasan;
            $kritik = "";
            for ($i = 1; $i <= 5; $i++) {
                if ($rataulasan >= $i) {
                    $kritik .= '<span class="fa fa-star checked" style="color:#ffc700;font-size:15pt"></span>';
                } else {
                    $kritik .= '<span class="fa fa-star" style="font-size:15pt"></span>';
                }
            }
            ?>
            <div class="col-12 col-sm-12 col-lg-12 mb-5">
                <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.1);border:none">
                    <div class="card-body ml-4 mr-4 mt-4">
                        <div class="single-product-area mb-50">
                            <div class="row mb-3">
                                <div class="col-md-1 col-2">
                                    <img src="foto/<?= $data['fotoprofil'] ?>" width="100%" class="imageround" style="border-radius: 100%;">
                                </div>
                                <div class="col-md-11 col-10 my-auto">
                                    <h5><b><?= $data['nama'] ?></b></h5>
                                    <div class="row">
                                        <div class="col-6 col-md-6">
                                            <p><?= $data['email'] ?></p>
                                            <?php
                                            if (isset($_SESSION["pengguna"])) {
                                                $idpengguna = $_SESSION["pengguna"]['id'];
                                                $ambilcekulasan = $koneksi->query("SELECT * FROM ulasan WHERE idposting='$idposting' and idpengguna='$idpengguna'");
                                                $cekulasan = $ambilcekulasan->num_rows;
                                                if ($cekulasan == "0") {
                                            ?>
                                                    <a data-toggle="modal" data-target="#tambahulasan<?= $noposting ?>"><?= $kritik ?></a>
                                                <?php } else { ?>
                                                    <a data-toggle="modal" data-target="#editulasan<?= $noposting ?>"><?= $kritik ?></a>
                                                <?php } ?>
                                            <?php
                                            } else {
                                            ?>
                                                <?= $kritik ?>
                                            <?php } ?>
                                        </div>
                                        <div class="col-6 col-md-6">
                                            <ul class="labelbuttongrey float-right">
                                                <li><i class="fa fa-calendar text-green"></i> <?= tanggal(date("Y-m-d", strtotime($data['waktu']))) . ' ' . date("H:i", strtotime($data['waktu'])); ?> W.I.B
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-info mt-15 text-justify">
                                <p><?php echo $data['caption'] ?></p>
                            </div>
                            <div class="row">
                                <?php
                                $nofoto = 1;
                                $ambilfoto = $koneksi->query("SELECT * FROM postingfoto where idposting='$data[idposting]'");
                                while ($foto = $ambilfoto->fetch_assoc()) {
                                ?>
                                    <div class="col-md-6">
                                        <a href="#" data-toggle="modal" data-target="#fotoposting<?= $noposting ?>_<?= $nofoto ?>">
                                            <?php
                                            $path = 'foto/' . $foto['fotoposting'];
                                            $extension = pathinfo($path, PATHINFO_EXTENSION);
                                            ?>
                                            <?php if ($extension == 'mp4') { ?>
                                                <video width="100%" style="height: 300px;" controls>
                                                    <source src="<?php echo 'foto/' . $foto['fotoposting']; ?>" type="video/mp4" width="100%" style="height:300px; object-fit: cover;border-radius:5px">
                                                    Your browser does not support the video tag.
                                                </video>
                                            <?php } else { ?>
                                                <img src="foto/<?= $foto['fotoposting'] ?>" width="100%" style="height:300px; object-fit: cover;border-radius:5px" alt="">
                                            <?php } ?>
                                        </a>
                                    </div>
                                <?php
                                    $nofoto++;
                                } ?>
                            </div>
                            <br>
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
                                        <a href="likepostingdetail.php?idposting=<?= $idposting ?>&jenis=Like"><i class="fa fa-thumbs-up fa-6x thumbs-icon <?= $aktif ?>"><?= $hitunglike ?></i></a>
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
                                        <a href="likepostingdetail.php?idposting=<?= $idposting ?>&jenis=Dislike"><i class="fa fa-thumbs-down fa-6x thumbs-icon <?= $aktif ?>"><?= $hitungdislike ?></i></a>
                                    <?php } else { ?>
                                        <i class="fa fa-thumbs-up fa-6x thumbs-icon"><?= $hitunglike ?></i>
                                        &nbsp;
                                        &nbsp;
                                        <i class="fa fa-thumbs-down fa-6x thumbs-icon"><?= $hitungdislike ?></i>
                                    <?php } ?>
                                    <!-- share -->
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
                            <br>
                            <div class="row">
                                <?php
                                if (isset($_SESSION["pengguna"])) { ?>
                                    <div class="col-md-12">
                                        <form class="form-contact contact_form" method="post">
                                            <div class="row">
                                                <input type="hidden" name="idposting" value="<?= $data['idposting'] ?>" class="form-control">
                                                <input type="hidden" name="id" value="<?= $_SESSION['pengguna']['id'] ?>" class="form-control">
                                                <div class="col-12">
                                                    <div class="form-group mb-3">
                                                        <textarea class="form-control" placeholder="Komentar" rows="3" name="komentar" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button name="simpankomentar" value="simpankomentar" type="submit" class="btn btn-primary float-right">Kirim</button>
                                            </div>
                                        </form>
                                    </div>
                                <?php } ?>
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
                </div>
                <!-- tambahulasan -->
                <div class="modal fade" id="tambahulasan<?= $noposting ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?= $noposting ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel<?= $noposting ?>">Berikan Ulasan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post">
                                <div class="modal-body">
                                    <div class="form-group mb-5">
                                        <input type="hidden" name="idposting" value="<?= $data['idposting'] ?>">
                                        <input type="hidden" name="idpengguna" value="<?= $idpengguna ?>">
                                        <label for="kritik">Rating</label> <br>
                                        <div class="bintang" id="bintang1<?= $noposting ?>">
                                            <input type="radio" id="star5<?= $noposting ?>" name="bintang" value="5" required />
                                            <label for="star5<?= $noposting ?>" title="text">5 Bintang</label>
                                            <input type="radio" id="star4<?= $noposting ?>" name="bintang" value="4" required />
                                            <label for="star4<?= $noposting ?>" title="text">4 Bintang</label>
                                            <input type="radio" id="star3<?= $noposting ?>" name="bintang" value="3" required />
                                            <label for="star3<?= $noposting ?>" title="text">3 Bintang</label>
                                            <input type="radio" id="star2<?= $noposting ?>" name="bintang" value="2" required />
                                            <label for="star2<?= $noposting ?>" title="text">2 Bintang</label>
                                            <input type="radio" id="star1<?= $noposting ?>" name="bintang" value="1" required />
                                            <label for="star1<?= $noposting ?>" title="text">1 Bintang</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                    <button type="submit" name="simpan" value="simpan" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="editulasan<?= $noposting ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel<?= $noposting ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel<?= $noposting ?>">Berikan Ulasan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php
                            $ambilulasan = $koneksi->query("SELECT * FROM ulasan WHERE idposting='$idposting'");
                            $ulasan = $ambilulasan->fetch_assoc();
                            ?>
                            <form method="post">
                                <div class="modal-body">
                                    <div class="form-group mb-5">
                                        <input type="hidden" name="idulasan" value="<?= $ulasan['idulasan'] ?>">
                                        <label for="kritik">Rating</label> <br>
                                        <div class="bintang" id="bintang2<?= $no ?>">
                                            <input <?php if ($ulasan['bintang'] == '5') echo 'checked'; ?> type="radio" id="stara<?= $no ?>" name="rate" value="5" required />
                                            <label for="stara<?= $no ?>" title="text">5 Bintang</label>
                                            <input <?php if ($ulasan['bintang'] == '4') echo 'checked'; ?> type="radio" id="starb<?= $no ?>" name="rate" value="4" required />
                                            <label for="starb<?= $no ?>" title="text">4 Bintang</label>
                                            <input <?php if ($ulasan['bintang'] == '3') echo 'checked'; ?> type="radio" id="starc<?= $no ?>" name="rate" value="3" required />
                                            <label for="starc<?= $no ?>" title="text">3 Bintang</label>
                                            <input <?php if ($ulasan['bintang'] == '2') echo 'checked'; ?> type="radio" id="stard<?= $no ?>" name="rate" value="2" required />
                                            <label for="stard<?= $no ?>" title="text">2 Bintang</label>
                                            <input <?php if ($ulasan['bintang'] == '1') echo 'checked'; ?>type="radio" id="stare<?= $no ?>" name="rate" value="1" required />
                                            <label for="stare<?= $no ?>" title="text">1 Bintang</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                    <button type="submit" name="ubah" value="ubah" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--  -->
            </div>
            <?php
            $nofoto = 1;
            $ambilfoto = $koneksi->query("SELECT * FROM postingfoto where idposting='$data[idposting]'");
            while ($foto = $ambilfoto->fetch_assoc()) {
            ?>
                <div class="modal fade" id="fotoposting<?= $noposting ?>_<?= $nofoto ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index:9999999">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <?php
                                $path = 'foto/' . $foto['fotoposting'];
                                $extension = pathinfo($path, PATHINFO_EXTENSION);
                                ?>
                                <?php if ($extension == 'mp4') { ?>
                                    <video width="100%" style="height: 500px;" controls>
                                        <source src="<?php echo 'foto/' . $foto['fotoposting']; ?>" type="video/mp4" width="100%" style="height:500px; object-fit: cover;border-radius:5px">
                                        Your browser does not support the video tag.
                                    </video>
                                <?php } else { ?>
                                    <img src="foto/<?= $foto['fotoposting'] ?>" width="100%" style="height:500px; object-fit: cover;border-radius:5px" alt="">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
                $nofoto++;
            } ?>
            <?php
            $noposting++;
            ?>
        </div>
    </div>
</main>
<?php
include 'footer.php';
?>
<?php
if (isset($_POST["simpan"])) {
    $idposting = $_POST['idposting'];
    $idpengguna = $_POST['idpengguna'];
    $bintang = $_POST['bintang'];
    $koneksi->query("INSERT INTO ulasan	(idposting,idpengguna,bintang)
								VALUES('$idposting','$idpengguna','$bintang')") or die(mysqli_error($koneksi));
    echo "<script>alert('Rating Berhasil Di Kirim')</script>";
    echo "<script>location='postingdetail.php?id=$_GET[id]';</script>";
}
if (isset($_POST["ubah"])) {
    $idulasan = $_POST['idulasan'];
    $rate = $_POST['rate'];
    $koneksi->query("UPDATE ulasan SET bintang='$rate' WHERE idulasan='$idulasan'") or die(mysqli_error($koneksi));
    echo "<script>alert('Ulasan Berhasil Di Diubah')</script>";
    echo "<script>location='postingdetail.php?id=$_GET[id]';</script>";
}
if (isset($_POST['simpankomentar'])) {
    $koneksi->query("INSERT INTO komentar
		(idposting,id,komentar)
		VALUES('$_POST[idposting]','$_POST[id]','$_POST[komentar]')") or die(mysqli_error($koneksi));
    echo "<script>alert('Komentar Anda Berhasil Di Kirim');</script>";
    echo "<script>location='postingdetail.php?id=$_GET[id]';</script>";
}
?>