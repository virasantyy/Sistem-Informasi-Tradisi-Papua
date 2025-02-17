<?php
include '../koneksi.php';
$koneksi->query("DELETE FROM informasifoto WHERE idinformasifoto='$_GET[id]'");
echo "<script>alert('Foto Informasi Berhasil Di Hapus');</script>";
echo "<script>location='index.php?halaman=informasiedit&id=$_GET[idinformasi]';</script>";
