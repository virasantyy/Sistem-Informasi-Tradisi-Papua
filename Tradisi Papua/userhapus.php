
<?php
$koneksi->query("DELETE FROM pengguna WHERE id='$_GET[id]'");
$koneksi->query("DELETE FROM posting WHERE idpengguna='$_GET[id]'");
$koneksi->query("DELETE FROM pendaftaran WHERE idpendaftaran='$_GET[id]'");
// $koneksi->query("DELETE FROM pengguna WHERE idpengguna='$_GET[id]'");
echo "<script>alert('User Berhasil Di Hapus');</script>";
echo "<script> location ='index.php?halaman=userdaftar';</script>";

?>