// <?php

    // $ambil = $koneksi->query("SELECT*FROM informasi WHERE idinformasi='$_GET[id]'");
    // $data = $ambil->fetch_assoc();
    // $foto = $data['foto'];
    // if (file_exists("../foto$foto")) {
    // 	unlink("../foto$foto");
    // }


    $koneksi->query("DELETE FROM informasi WHERE idinformasi='$_GET[id]'");

    echo "<script>alert('Informasi Berhasil Di Hapus');</script>";
    echo "<script>location='index.php?halaman=informasidaftar';</script>";
