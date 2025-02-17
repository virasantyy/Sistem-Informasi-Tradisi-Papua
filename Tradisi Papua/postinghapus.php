
<?php
$koneksi->query("DELETE FROM posting WHERE idposting='$_GET[id]'");
$koneksi->query("DELETE FROM postingfoto WHERE idposting='$_GET[id]'");
echo "<script>alert('Postingan Berhasil Di Hapus');</script>";
echo "<script> location ='index.php?halaman=postingdaftar';</script>";
