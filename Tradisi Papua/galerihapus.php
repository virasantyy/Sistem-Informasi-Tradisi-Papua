
<?php
$koneksi->query("DELETE FROM galeri WHERE idgaleri='$_GET[id]'");
echo "<script>alert('Galeri Berhasil Di Hapus');</script>";
echo "<script> location ='index.php?halaman=galeridaftar';</script>";

?>