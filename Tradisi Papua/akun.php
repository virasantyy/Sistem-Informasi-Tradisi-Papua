<?php
include 'header.php';
include 'koneksi.php';
if (!isset($_SESSION["pengguna"])) {
    echo "<script> alert('Harap login terlebih dahulu');</script>";
    echo "<script> location ='login.php';</script>";
}
$id = $_SESSION["pengguna"]['id'];
$ambil = $koneksi->query("SELECT *FROM pengguna WHERE id='$id'");
$row = $ambil->fetch_assoc(); ?>
<div class="breadcrumb-area">
    <div class="top-breadcrumb-area bg-img bg-overlay d-flex align-items-center justify-content-center" style="background-image: url(foto/home.jpg);">
        <h2>Profil</h2>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i> Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Profil</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="contact-area">
    <div class="container">
        <div class="row align-items-center justify-content-between">
            <div class="col-12 col-lg-12">
                <div class="section-heading">
                    <h2>Profil</h2>
                </div>
                <div class="contact-form-area mb-100">
                    <form method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-3">
                                <img src="foto/<?= $row['fotoprofil'] ?>" width="100%" style="border-radius: 10px;">
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input type="text" value="<?php echo $row['nama']; ?>" class="form-control" name="nama">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password">
                                            <input type="hidden" class="form-control" name="passwordlama" value="<?php echo $row['password']; ?>">
                                            <span class="text-danger">Kosongkan Password jika tidak ingin mengganti</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>No. HP</label>
                                            <input type="number" class="form-control" name="nohp" value="<?php echo $row['nohp']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea class="form-control" name="alamat" required cols="30" rows="10"><?php echo $row['alamat']; ?></textarea>
                                            <script>
                                                CKEDITOR.replace('alamat');
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Foto</label>
                                            <input type="file" class="form-control" name="foto">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn alazea-btn mt-15" name="ubah">Simpan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
if (isset($_POST['ubah'])) {
    if ($_POST['password'] == "") {
        $password = $_POST['passwordlama'];
    } else {
        $password = md5($_POST['password']);
    }
    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];
    if (!empty($lokasifoto)) {
        move_uploaded_file($lokasifoto, "foto/$namafoto");
        $koneksi->query("UPDATE pengguna SET password='$password',nama='$_POST[nama]', email='$_POST[email]',nohp='$_POST[nohp]', alamat='$_POST[alamat]', fotoprofil='$namafoto' WHERE id='$id'") or die(mysqli_error($koneksi));
    } else {
        $koneksi->query("UPDATE pengguna SET password='$password',nama='$_POST[nama]', email='$_POST[email]',nohp='$_POST[nohp]', alamat='$_POST[alamat]' WHERE id='$id'") or die(mysqli_error($koneksi));
    }
    echo "<script>alert('Profil Berhasil Di Ubah');</script>";
    echo "<script>location='akun.php';</script>";
}
include 'footer.php';
?>