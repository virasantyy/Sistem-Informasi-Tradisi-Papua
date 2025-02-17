
<?php
$koneksi->query("DELETE FROM kategori WHERE idkategori='$_GET[id]'");
echo "<script>alert('Kategori Berhasil Di Hapus');</script>";
echo "<script> location ='index.php?halaman=kategoridaftar';</script>";

?>