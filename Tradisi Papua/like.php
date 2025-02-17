
<?php
include 'koneksi.php';
session_start();
$idposting = $_GET['idposting'];
$jenis = $_GET['jenis'];
$idpengguna = $_SESSION['pengguna']['id'];
$ambilceklike = mysqli_query($koneksi, "SELECT * FROM likedislike where idposting = '$idposting' and id='$idpengguna'");
$ceklike = $ambilceklike->num_rows;
$data = $ambilceklike->fetch_assoc();
if ($ceklike >= 1) {
    if ($data['jenis'] == $jenis) {
        $koneksi->query("DELETE FROM likedislike where idposting = '$idposting' and id='$idpengguna'");
    } else {
        $koneksi->query("DELETE FROM likedislike where idposting = '$idposting' and id='$idpengguna'");
        $koneksi->query("INSERT INTO likedislike
        (idposting,id,jenis)
        VALUES('$idposting','$idpengguna','$jenis')") or die(mysqli_error($koneksi));
    }
} else {
    $koneksi->query("INSERT INTO likedislike
(idposting,id,jenis)
VALUES('$idposting','$idpengguna','$jenis')") or die(mysqli_error($koneksi));
}
echo "<script> location ='posting.php';</script>";
?>